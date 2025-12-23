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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Main phone image
            'variants' => 'required|array|min:1', // Yêu cầu ít nhất 1 biến thể
            'variants.*.size_id' => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Variant image
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Multiple phone images
        ], [
            'variants.required' => 'Sản phẩm phải có ít nhất một biến thể.',
            'variants.*.price.required' => 'Giá của biến thể là bắt buộc.',
            'variants.*.price.numeric' => 'Giá của biến thể phải là số.',
            'variants.*.stock.required' => 'Số lượng tồn kho của biến thể là bắt buộc.',
            'variants.*.stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
        ]);

        DB::beginTransaction(); // Bắt đầu transaction

        try {
            $mainImagePath = null;  
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
            }

            $phone = phone::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $mainImagePath,
            ]);

            // Thêm các biến thể (variants)
            foreach ($request->variants as $variantData) {
                $variantImagePath = null;
                // Kiểm tra nếu có file ảnh riêng cho biến thể
                if (isset($variantData['image_path']) && $variantData['image_path']->isValid()) {
                    $variantImagePath = $variantData['image_path']->store('phones/variants', 'public');
                }

                $phone->variants()->create([
                    'size_id' => $variantData['size_id'] ?? null,
                    'color_id' => $variantData['color_id'] ?? null,
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'image_path' => $variantImagePath,
                    'is_default' => isset($variantData['is_default']) && $variantData['is_default'] ? true : false,
                ]);
            }

            // Thêm các hình ảnh khác cho sản phẩm (nếu có)
            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $otherImage) {
                    $otherImagePath = $otherImage->store('phones/gallery', 'public');
                    $phone->images()->create([
                        'image_path' => $otherImagePath,
                    ]);
                }
            }

            DB::commit(); // Hoàn tất transaction
            return redirect()->route('admin.phones.index')->with('success', 'Sản phẩm và biến thể đã được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm: ' . $e->getMessage())->withInput();
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

        return redirect()->route('phones.index')->with('info', 'Trang chi tiết sản phẩm không được hỗ trợ trực tiếp. Vui lòng sử dụng chức năng xem chi tiết');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:phone_variants,id',
            'variants.*.size_id' => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'existing_other_images' => 'nullable|array', // ID của các ảnh phụ hiện có mà muốn giữ lại
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ảnh phụ mới
        ]);

        DB::beginTransaction();

        try {
            // Cập nhật ảnh chính
            if ($request->hasFile('main_image')) {
                // Xóa ảnh cũ nếu có
                if ($phone->main_image) {
                    Storage::disk('public')->delete($phone->main_image);
                }
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
                $phone->main_image = $mainImagePath;
            } elseif ($request->input('remove_main_image')) { // Thêm tùy chọn xóa ảnh chính
                if ($phone->main_image) {
                    Storage::disk('public')->delete($phone->main_image);
                    $phone->main_image = null;
                }
            }


            $phone->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $phone->main_image, // Cập nhật lại đường dẫn ảnh chính
            ]);

            // Xử lý biến thể: Thêm mới, cập nhật, xóa cũ
            $existingVariantIds = $phone->variants->pluck('id')->toArray();
            $variantsToKeep = [];

            foreach ($request->variants as $variantData) {
                if (isset($variantData['id']) && $variantData['id']) {
                    // Cập nhật biến thể hiện có
                    $variant = Variant::find($variantData['id']);
                    if ($variant) {
                        $variantsToKeep[] = $variant->id;

                        // Cập nhật ảnh biến thể
                        if (isset($variantData['image_path']) && $variantData['image_path']->isValid()) {
                            if ($variant->image_path) {
                                Storage::disk('public')->delete($variant->image_path);
                            }
                            $variantImagePath = $variantData['image_path']->store('phones/variants', 'public');
                            $variant->image_path = $variantImagePath;
                        } elseif (isset($variantData['remove_image_path']) && $variantData['remove_image_path']) {
                            if ($variant->image_path) {
                                Storage::disk('public')->delete($variant->image_path);
                                $variant->image_path = null;
                            }
                        }

                        $variant->update([
                            'size_id' => $variantData['size_id'] ?? null,
                            'color_id' => $variantData['color_id'] ?? null,
                            'sku' => $variantData['sku'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'],
                            'is_default' => isset($variantData['is_default']) && $variantData['is_default'] ? true : false,
                            'image_path' => $variant->image_path, // Cập nhật lại đường dẫn ảnh biến thể
                        ]);
                    }
                } else {
                    // Thêm biến thể mới
                    $variantImagePath = null;
                    if (isset($variantData['image_path']) && $variantData['image_path']->isValid()) {
                        $variantImagePath = $variantData['image_path']->store('phones/variants', 'public');
                    }
                    $phone->variants()->create([
                        'size_id' => $variantData['size_id'] ?? null,
                        'color_id' => $variantData['color_id'] ?? null,
                        'sku' => $variantData['sku'] ?? null,
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'image_path' => $variantImagePath,
                        'is_default' => isset($variantData['is_default']) && $variantData['is_default'] ? true : false,
                    ]);
                }
            }

            // Xóa các biến thể không còn trong request
            Variant::where('phone_id', $phone->id)
                ->whereNotIn('id', $variantsToKeep)
                ->each(function ($variant) {
                    if ($variant->image_path) {
                        Storage::disk('public')->delete($variant->image_path);
                    }
                    $variant->delete();
                });


            // Xử lý các hình ảnh phụ
            $existingImageIds = $request->input('existing_other_images', []);
            // Xóa các ảnh phụ không còn được giữ lại
            $phone->images()->whereNotIn('id', $existingImageIds)->each(function ($image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            });

            // Thêm các ảnh phụ mới
            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $otherImage) {
                    $otherImagePath = $otherImage->store('phones/gallery', 'public');
                    $phone->images()->create([
                        'image_path' => $otherImagePath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.phones.index')->with('success', 'Sản Phẩm và biến thể đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi khi cập nhật sản phẩm: ' . $e->getMessage())->withInput();
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
