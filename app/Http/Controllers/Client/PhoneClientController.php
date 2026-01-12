<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneClientController extends Controller
{
    public function listByCategory(Request $request, $slug)
    {
        // 1. Tìm danh mục hiện tại
        $currentCategory = Category::where('slug', $slug)
            ->active()
            ->with('children')
            ->firstOrFail();

        $isIphone = \Illuminate\Support\Str::contains(strtolower($currentCategory->name), 'iphone');

        $categoryIds = $currentCategory->getAllChildIds();

        // 2. Khởi tạo Query lấy Phone
        $query = Phone::where('is_active', true)->whereIn('phones.category_id', $categoryIds)

            ->join('variants', 'phones.id', '=', 'variants.phone_id')
            // Tính toán các giá trị ảo để lọc/sắp xếp
            ->select(
                'phones.*',
                DB::raw('MIN(variants.price) as min_price'),
                DB::raw('SUM(variants.view) as total_views')
            )
            ->groupBy(
                'phones.id',
                'phones.category_id',
                'phones.name',
                'phones.slug',
                'phones.short_description',
                'phones.is_active',
                'phones.main_image',
                'phones.created_at',
                'phones.updated_at',
                'phones.deleted_at'
            );

        // 3. Xử lý BỘ LỌC (Filter)
        // Lọc theo khoảng giá (nếu có)
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case 'under_500':
                    $query->having('min_price', '<', 500000);
                    break;
                case '500_1000':
                    $query->havingBetween('min_price', [500000, 1000000]);
                    break;
                case 'over_1000':
                    $query->having('min_price', '>', 1000000);
                    break;
            }
        }

        // 4. Xử lý SẮP XẾP (Sorting)
        $sort = $request->get('sort', 'latest'); // Mặc định là mới nhất
        switch ($sort) {
            case 'latest':
                $query->orderBy('phones.created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('phones.created_at', 'asc');
                break;
            case 'price_asc':
                $query->orderBy('min_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('min_price', 'desc');
                break;
            case 'popular':
                $query->orderBy('total_views', 'desc');
                break;
        }

        // 5. Thực thi và Phân trang
        $iphones = $query->with(['category', 'variants'])
            ->paginate(100)
            ->withQueryString(); // Quan trọng: Giữ lại tham số trên URL khi chuyển trang

        $categories_iphone = $currentCategory->children()->active()->ordered()->get();

        return view(
            'phones.categories.phone-list',
            compact(
                'iphones',
                'currentCategory',
                'categories_iphone',
                'isIphone'
            )
        );
    }

    // phones detail
    public function phoneDetail($slug)
    {
        // 1. Lấy thông tin Phone cùng các quan hệ liên quan
        $phone = Phone::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',
                'images',
                'variants.color',
                'variants.size'
            ])
            ->firstOrFail();

        $allImages = collect([$phone->main_image]);
        $parentId = $phone->category->parent_id ?? $phone->category_id;

        $categoryIds = Category::where('parent_id', $parentId)
            ->orWhere('id', $parentId)
            ->pluck('id');

        foreach ($phone->images as $img) {
            $allImages->push($img->image_path);
        }

        foreach ($phone->variants as $variant) {
            if ($variant->image_path) {
                $allImages->push($variant->image_path);
            }
        }

        // Xóa các ảnh trùng lặp
        $allImages = $allImages->unique();

        // 2. Lấy toàn bộ variants (không lọc theo stock để hiển thị cả hàng sắp về)
        $variants = $phone->variants;

        // 3. Kiểm tra xem có phải iPhone không để logic hiển thị banner/quà tặng riêng
        $isIphone = \Illuminate\Support\Str::contains(strtolower($phone->name), 'iphone');

        // 4. Lấy danh sách duy nhất các Condition, Color, Size để hiển thị nút chọn
        // Chúng ta dùng collection để lọc từ danh sách variants đã lấy
        $availableConditions = $variants->pluck('condition')->unique()->values();
        $availableSizes = $variants->pluck('size')->unique('id')->values();
        $availableColors = $variants->pluck('color')->unique('id')->values();


        $relatedPhones = Phone::whereIn('category_id', $categoryIds) // Dùng whereIn thay vì where
            ->where('id', '!=', $phone->id) // Loại trừ sản phẩm hiện tại
            ->where('is_active', true)
            ->with(['category', 'variants'])
            ->limit(4)
            ->get();

        return view('phones.phone-detail', compact(
            'phone',
            'variants',
            'isIphone',
            'availableConditions',
            'availableSizes',
            'availableColors',
            'allImages',
            'relatedPhones'
        ));
    }

}
