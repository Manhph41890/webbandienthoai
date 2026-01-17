<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\Category; // Đảm bảo import Category model
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage; // Để quản lý file
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\Variant;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Khởi tạo query với tổng kho và giá nhỏ nhất để sắp xếp
        $query = Phone::with('category', 'variants.size', 'variants.color')->withSum('variants as total_stock', 'stock')->withMin('variants as min_price', 'price');

        $trashedCount = Phone::onlyTrashed()->count();
        // LẤY DANH MỤC CẤP CUỐI:
        // - whereDoesntHave('children'): Không có con
        // - where('name', 'NOT LIKE', '%gói cước%'): Loại trừ gói cước (có thể dùng slug tùy bạn)
        $categories = Category::whereDoesntHave('children')->where('name', 'NOT LIKE', '%gói cước%')->orderBy('name', 'asc')->get();

        // 2. Tìm kiếm theo tên/danh mục
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            });
        }

        // 3. Lọc theo Danh mục (Nâng cấp để lọc được cả con nếu chọn cha)
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            if ($category) {
                // Lấy tất cả ID của chính nó và các con (đề phòng sau này bạn đổi ý hiện danh mục cha)
                $categoryIds = $category->getAllChildIds();
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // 3. Lọc theo Danh mục & Trạng thái
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // 4. Lọc theo Khoảng giá
        if ($request->filled('min_price')) {
            $query->whereHas('variants', fn($q) => $q->where('price', '>=', $request->min_price));
        }
        if ($request->filled('max_price')) {
            $query->whereHas('variants', fn($q) => $q->where('price', '<=', $request->max_price));
        }

        // 5. Lọc theo Tình trạng máy (Mới/Cũ) - MỚI
        if ($request->filled('condition')) {
            $query->whereHas('variants', fn($q) => $q->where('condition', $request->condition));
        }

        // 6. Lọc theo Kho hàng
        if ($request->filled('stock_status')) {
            $status = $request->stock_status;
            if ($status == 'out_of_stock') {
                $query->having('total_stock', '=', 0);
            } elseif ($status == 'low_stock') {
                $query->having('total_stock', '>', 0)->having('total_stock', '<=', 5);
            } elseif ($status == 'in_stock') {
                $query->having('total_stock', '>', 5);
            }
        }

        // 7. Sắp xếp (Sorting) - MỚI
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('min_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('min_price', 'desc');
                break;
            case 'stock_asc':
                $query->orderBy('total_stock', 'asc');
                break;
            case 'stock_desc':
                $query->orderBy('total_stock', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        // 8. Phân trang tùy chỉnh số lượng - MỚI
        $perPage = $request->get('per_page', 10);
        $phones = $query->paginate($perPage)->withQueryString();

        return view('admin.phones.index', compact('phones', 'trashedCount', 'categories'));
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

    public function store(StorePhoneRequest $request)
    {
        DB::beginTransaction();

        try {
            // 1. Xử lý Slug
            $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
            if (Phone::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            // 2. Lưu ảnh chính sản phẩm
            $mainImagePath = null;
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
            }

            // 3. Tạo sản phẩm cha (Phone)
            $phone = Phone::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $slug,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $mainImagePath,
                'is_active' => 1,
            ]);

            // 4. Xử lý các biến thể (Variants)
            if ($request->has('variants')) {
                foreach ($request->variants as $variantData) {
                    // Xử lý ảnh biến thể
                    $variantImagePath = null;
                    if (isset($variantData['image_path']) && $variantData['image_path'] instanceof \Illuminate\Http\UploadedFile) {
                        $variantImagePath = $variantData['image_path']->store('phones/variants', 'public');
                    }

                    // Gom nhóm thông tin cấu hình chung (JSON general_specs)
                    $generalSpecs = [
                        'storage' => $variantData['general_specs']['storage'] ?? null,
                        'ram' => $variantData['general_specs']['ram'] ?? null,
                        'screen_size' => $variantData['general_specs']['screen_size'] ?? null,
                    ];

                    // Gom nhóm thông tin máy cũ (JSON used_details)
                    $usedDetails = null;
                    $condition = $variantData['condition'] ?? 'new';

                    if ($condition === 'used') {
                        $usedDetails = [
                            'battery_health' => $variantData['used_details']['battery_health'] ?? null,
                            'charging_cycles' => $variantData['used_details']['charging_cycles'] ?? null,
                            'description' => $variantData['used_details']['description'] ?? null,
                        ];
                    }

                    // Lưu biến thể vào database
                    $phone->variants()->create([
                        'size_id' => $variantData['size_id'] ?? null,
                        'color_id' => $variantData['color_id'] ?? null,
                        'sku' => $variantData['sku'] ?? null,
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'image_path' => $variantImagePath,
                        'condition' => $condition,
                        'general_specs' => $generalSpecs, // Laravel tự động cast sang JSON
                        'used_details' => $usedDetails, // Laravel tự động cast sang JSON
                        'is_default' => isset($variantData['is_default']),
                        'status' => 'còn_hàng',
                    ]);
                }
            }

            // 5. Lưu ảnh phụ (Gallery)
            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $otherImage) {
                    $otherImagePath = $otherImage->store('phones/gallery', 'public');
                    $phone->images()->create(['image_path' => $otherImagePath]);
                }
            }

            DB::commit();
            Alert::success('Thành công', 'Sản phẩm và biến thể đã được thêm thành công.');
            return redirect()->route('admin.phones.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi thêm sản phẩm: ' . $e->getMessage());
            Alert::error('Lỗi', 'Có lỗi xảy ra: ' . $e->getMessage());
            return back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        // Đảm bảo load đầy đủ các quan hệ
        $phone->load(['category', 'variants.size', 'variants.color', 'images']);

        if (request()->ajax()) {
            // Trả về view partial cho AJAX
            return view('admin.phones.show_modal_content', compact('phone'));
        }

        return redirect()->route('admin.phones.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        // Load mối quan hệ để hiển thị dữ liệu hiện tại (biến thể và ảnh phụ)
        $phone->load(['variants', 'images']);

        return view('admin.phones.edit', compact('phone', 'categories', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        DB::beginTransaction();
        try {
            // 1. Xử lý ảnh chính (Main Image)
            $mainImagePath = $phone->main_image;
            if ($request->hasFile('main_image')) {
                if ($phone->main_image) {
                    Storage::disk('public')->delete($phone->main_image);
                }
                $mainImagePath = $request->file('main_image')->store('phones/main', 'public');
            } elseif ($request->has('remove_main_image')) {
                if ($phone->main_image) {
                    Storage::disk('public')->delete($phone->main_image);
                }
                $mainImagePath = null;
            }

            // 2. Cập nhật thông tin Phone
            $phone->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'main_image' => $mainImagePath,
            ]);

            // 3. Xử lý các biến thể (Variants)
            $variantsToKeep = []; // Mảng lưu ID các biến thể còn giữ lại

            foreach ($request->variants as $index => $variantData) {
                // --- BẮT ĐẦU GOM NHÓM DỮ LIỆU JSON ---
                $generalSpecs = [
                    'storage' => $variantData['general_specs']['storage'] ?? null,
                    'ram' => $variantData['general_specs']['ram'] ?? null,
                    'screen_size' => $variantData['general_specs']['screen_size'] ?? null,
                ];

                $condition = $variantData['condition'] ?? 'new';
                $usedDetails = null;
                if ($condition === 'used') {
                    $usedDetails = [
                        'battery_health' => $variantData['used_details']['battery_health'] ?? null,
                        'charging_cycles' => $variantData['used_details']['charging_cycles'] ?? null,
                        'description' => $variantData['used_details']['description'] ?? null,
                    ];
                }
                // --- KẾT THÚC GOM NHÓM DỮ LIỆU JSON ---

                // Nếu là biến thể đã tồn tại (có ID)
                if (isset($variantData['id'])) {
                    $variant = $phone->variants()->find($variantData['id']);
                    if ($variant) {
                        $variantsToKeep[] = $variant->id;
                        $variantImagePath = $variant->image_path;

                        // Cập nhật ảnh biến thể nếu có file mới
                        if ($request->hasFile("variants.$index.image_path")) {
                            if ($variant->image_path) {
                                Storage::disk('public')->delete($variant->image_path);
                            }
                            $variantImagePath = $request->file("variants.$index.image_path")->store('phones/variants', 'public');
                        }

                        $variant->update([
                            'size_id' => $variantData['size_id'] ?? null,
                            'color_id' => $variantData['color_id'] ?? null,
                            'sku' => $variantData['sku'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'],
                            'image_path' => $variantImagePath,
                            'condition' => $condition,
                            'general_specs' => $generalSpecs,
                            'used_details' => $usedDetails,
                            'is_default' => isset($variantData['is_default']),
                        ]);
                    }
                } else {
                    // Thêm biến thể mới hoàn toàn (những cái ấn nút "Thêm" ở trang Edit)
                    $variantImagePath = null;
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
                        'condition' => $condition,
                        'general_specs' => $generalSpecs,
                        'used_details' => $usedDetails,
                        'is_default' => isset($variantData['is_default']),
                        'status' => 'còn_hàng',
                    ]);
                    $variantsToKeep[] = $newVariant->id;
                }
            }

            // Xóa những biến thể không còn nằm trong danh sách gửi lên (bị bấm nút Xóa ở UI)
            $phone
                ->variants()
                ->whereNotIn('id', $variantsToKeep)
                ->each(function ($v) {
                    if ($v->image_path) {
                        Storage::disk('public')->delete($v->image_path);
                    }
                    $v->delete();
                });

            // 4. Xử lý ảnh phụ (Gallery)
            $existingImageIds = $request->input('existing_other_images', []);
            $phone
                ->images()
                ->whereNotIn('id', $existingImageIds)
                ->each(function ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                });

            if ($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $file) {
                    $phone->images()->create([
                        'image_path' => $file->store('phones/gallery', 'public'),
                    ]);
                }
            }

            DB::commit();
            Alert::success('Thành công', 'Sản phẩm và biến thể đã được cập nhật thành công.');
            return redirect()->route('admin.phones.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error($e->getMessage());
            Log::error('Lỗi cập nhật: ' . $e->getMessage());
            return back()
                ->with('error', 'Lỗi cập nhật: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function changeStatus(Phone $phone)
    {
        try {
            $phone->is_active = !$phone->is_active;
            $phone->save();

            return response()->json([
                'success' => true,
                'is_active' => $phone->is_active,
                'message' => 'Cập nhật trạng thái thành công!',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra!',
                ],
                500,
            );
        }
    }

    public function toggleFeatured(Phone $phone)
    {
        try {
            // Cách 1: Đảo ngược giá trị hiện tại
            $phone->is_featured = !$phone->is_featured;
            $phone->save();

            // Hoặc Cách 2: Lấy giá trị từ request gửi lên (an toàn hơn)
            // $phone->update(['is_featured' => request('is_featured')]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái nổi bật thành công!',
                'is_featured' => (bool) $phone->is_featured,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Lỗi: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
    /**
     * Remove the specified resource from storage.
     */

    public function trash()
    {
        // Lấy danh sách điện thoại đã xóa mềm, nạp kèm các quan hệ để hiển thị thông tin
        $trashPhones = Phone::onlyTrashed()
            ->with(['category', 'variants'])
            ->latest('deleted_at')
            ->paginate(10); // Sử dụng paginate thay vì get để hiển thị được phân trang

        return view('admin.phones.trash', compact('trashPhones'));
    }

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
            Alert::success('Sản phẩm đã trong thùng rác');
            return redirect()->route('admin.phones.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Xóa thất bại' . $e->getMessage());
            return redirect()->back();
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

            Alert::success('Khôi phục điện thoại thành công');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Lỗi khôi phục: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        $phone = Phone::onlyTrashed()
            ->with(['variants', 'images'])
            ->findOrFail($id);

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
            return redirect()
                ->back()
                ->with('error', 'Lỗi xóa vĩnh viễn: ' . $e->getMessage());
        }
    }
}
