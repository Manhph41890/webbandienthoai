<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Category; // Đảm bảo import Category model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Để quản lý file
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\Variant;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Phone::with('category', 'variants.size', 'variants.color');
        $trashedCount = Phone::onlyTrashed()->count(); // Đếm số lượng điện thoại trong thùng rác


        // Xử lý tìm kiếm
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        $phones = $query->latest()->paginate(10); // Phân trang và sắp xếp mới nhất

        return view('admin.phones.index', compact('phones', 'trashedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.phones.create', compact('categories', 'sizes', 'colors'));
    }

    public function getVariantFormFields(Request $request)
    {
        $index = $request->query('index', 0); // Lấy index từ request, mặc định là 0
        $sizes = Size::all();
        $colors = Color::all();
        // Đảm bảo partial view này nhận đủ dữ liệu và render chính xác
        return view('admin.phones.variant_form_fields', compact('index', 'sizes', 'colors'))->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     * Lưu sản phẩm và các biến thể mới vào cơ sở dữ liệu.
     */
    public function store(StorePhoneRequest $request)
    {
        DB::beginTransaction();
        try {
            // Xử lý Slug ổn định
            $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

            // Kiểm tra nếu slug đã tồn tại thì thêm chuỗi ngẫu nhiên hoặc timestamp
            if (Phone::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            // Lưu ảnh chính
            $mainImagePath = null;
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
            }

            $phone = Phone::create([
                'categories_id' => $request->categories_id,
                'name' => $request->name,
                'slug' => $slug,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $mainImagePath,
                'status' => 'còn_hàng',
            ]);

            foreach ($request->variants as $variantData) {
                $variantImagePath = null;
                if (isset($variantData['image_path']) && $variantData['image_path']->isValid()) {
                    $variantImagePath = $variantData['image_path']->store('phones/variants', 'public');
                }

                $phone->variants()->create([
                    'size_id' => $variantData['size_id'] ?? null,
                    'color_id' => $variantData['color_id'] ?? null,
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'], // Lưu ý: Database của bạn dùng 'stock'
                    'image_path' => $variantImagePath,
                    'is_default' => isset($variantData['is_default']),
                    'status' => 'còn_hàng',
                ]);
            }

            // Ảnh phụ
            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $otherImage) {
                    $otherImagePath = $otherImage->store('phones/gallery', 'public');
                    $phone->images()->create(['image_path' => $otherImagePath]);
                }
            }

            DB::commit();
            return redirect()->route('admin.phones.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Lỗi: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        $phone->load('category', 'variants.size', 'variants.color', 'images');

        if (request()->ajax()) {
            return view('admin.phones.show_modal_content', compact('phone'));
        }

        return redirect()->route('admin.phones.index')->with('info', 'Trang chi tiết sản phẩm không được hỗ trợ trực tiếp. Vui lòng sử dụng chức năng xem chi tiết');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        // load mối quân hệ để hiển thị dữ liệu hiện tại
        $phone->load('variants');
        return view('admin.phones.edit', compact('phone', 'categories', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        DB::beginTransaction();
        try {
            // 1. Xử lý ảnh chính
            $mainImagePath = $phone->main_image;
            if ($request->hasFile('main_image')) {
                if ($phone->main_image) Storage::disk('public')->delete($phone->main_image);
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
            } elseif ($request->has('remove_main_image')) {
                if ($phone->main_image) Storage::disk('public')->delete($phone->main_image);
                $mainImagePath = null;
            }

            // 2. Cập nhật thông tin Phone
            $phone->update([
                'categories_id' => $request->categories_id,
                'name' => $request->name,
                'slug' => $request->slug, // Lấy từ request đã qua validate unique
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $mainImagePath,
            ]);

            // 3. Xử lý biến thể
            $variantsToKeep = [];
            foreach ($request->variants as $index => $variantData) {
                $variantImagePath = null;

                // Nếu là biến thể đã tồn tại
                if (isset($variantData['id'])) {
                    $variant = Variant::find($variantData['id']);
                    if ($variant) {
                        $variantsToKeep[] = $variant->id;
                        $variantImagePath = $variant->image_path;

                        // Cập nhật ảnh biến thể nếu có file mới
                        if ($request->hasFile("variants.$index.image_path")) {
                            if ($variant->image_path) Storage::disk('public')->delete($variant->image_path);
                            $variantImagePath = $request->file("variants.$index.image_path")->store('phones/variants', 'public');
                        }

                        $variant->update([
                            'size_id' => $variantData['size_id'] ?? null,
                            'color_id' => $variantData['color_id'] ?? null,
                            'sku' => $variantData['sku'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'], // Dùng 'stock' theo yêu cầu của bạn
                            'image_path' => $variantImagePath,
                            'is_default' => isset($variantData['is_default']),
                        ]);
                    }
                } else {
                    // Thêm biến thể mới hoàn toàn
                    if ($request->hasFile("variants.$index.image_path")) {
                        $variantImagePath = $request->file("variants.$index.image_path")->store('phones/variants', 'public');
                    }
                    $newVariant = $phone->variants()->create([
                        'size_id' => $variantData['size_id'] ?? null,
                        'color_id' => $variantData['color_id'] ?? null,
                        'sku' => $variantData['sku'] ?? null,
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'image_path' => $variantImagePath,
                        'is_default' => isset($variantData['is_default']),
                    ]);
                    $variantsToKeep[] = $newVariant->id;
                }
            }

            // Xóa những biến thể không còn nằm trong danh sách gửi lên
            $phone->variants()->whereNotIn('id', $variantsToKeep)->each(function ($v) {
                if ($v->image_path) Storage::disk('public')->delete($v->image_path);
                $v->delete();
            });

            // 4. Xử lý ảnh phụ (Gallery)
            $existingImageIds = $request->input('existing_other_images', []);
            $phone->images()->whereNotIn('id', $existingImageIds)->each(function ($img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            });

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $phone->images()->create([
                        'image_path' => $file->store('phones/gallery', 'public')
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.phones.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi cập nhật: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        DB::beginTransaction();

        try {
            // 1. Soft delete các biến thể liên quan để không hiển thị ngoài frontend
            $phone->variants()->delete();

            // 2. Soft delete các ảnh phụ (nếu bảng images cũng có soft delete)
            if (method_exists($phone->images(), 'delete')) {
                $phone->images()->delete();
            }

            // 3. Soft delete chính nó
            $phone->delete();

            DB::commit();
            return redirect()->route('admin.phones.index')
                ->with('success', 'Sản phẩm đã được chuyển vào thùng rác thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        // Tìm sản phẩm trong thùng rác
        $phone = Phone::onlyTrashed()->findOrFail($id);

        try {
            $phone->restore();
            // Khôi phục luôn các biến thể liên quan
            $phone->variants()->restore();

            return redirect()->back()->with('success', 'Đã khôi phục sản phẩm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khôi phục: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        $phone = Phone::onlyTrashed()->with(['variants', 'images'])->findOrFail($id);

        DB::beginTransaction();
        try {
            // 1. Xóa ảnh chính
            if ($phone->main_image) {
                Storage::disk('public')->delete($phone->main_image);
            }

            // 2. Xóa ảnh của các biến thể
            foreach ($phone->variants as $variant) {
                if ($variant->image_path) {
                    Storage::disk('public')->delete($variant->image_path);
                }
            }

            // 3. Xóa các ảnh phụ trong gallery
            foreach ($phone->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            // 4. Xóa vĩnh viễn trong DB (Xóa cứng)
            // Lưu ý: delete() các variant trước nếu không dùng onDelete('cascade') ở database
            $phone->variants()->forceDelete();
            $phone->forceDelete();

            DB::commit();
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa vĩnh viễn khỏi hệ thống!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi xóa vĩnh viễn: ' . $e->getMessage());
        }
    }
}
