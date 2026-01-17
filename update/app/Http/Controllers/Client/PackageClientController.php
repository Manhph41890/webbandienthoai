<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageClientController extends Controller
{
    public function listByCategory(Request $request, $slug)
    {
        // 1. Tìm danh mục hiện tại (ví dụ: 'vina-phone', 'viettel-4g')
        $currentCategory = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // 2. Lấy tất cả ID của danh mục con (để lấy sản phẩm của cả cấp con)
        $categoryIds = $currentCategory->getAllChildIds();

        // 3. Query lấy danh sách gói cước
        $query = Package::whereIn('category_id', $categoryIds)
            ->where('is_active', true);

        // 4. Lọc (Filter)
        if ($request->has('price_range')) {
            if ($request->price_range == 'under_100') $query->where('price', '<', 100000);
            if ($request->price_range == '100_500') $query->whereBetween('price', [100000, 500000]);
            if ($request->price_range == 'over_500') $query->where('price', '>', 500000);
        }

        // 5. Sắp xếp
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $packages = $query->paginate(12)->withQueryString();

        // 6. Lấy các danh mục con để hiển thị bộ lọc/tab nếu cần
        $subCategories = $currentCategory->children()->active()->ordered()->get();

        return view('packages.index', compact('packages', 'currentCategory', 'subCategories'));
    }

    public function detail($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Gói cước liên quan (cùng nhà mạng/danh mục)
        $relatedPackages = Package::where('category_id', $package->category_id)
            ->where('id', '!=', $package->id)
            ->limit(4)
            ->get();

        return view('packages.detail', compact('package', 'relatedPackages'));
    }
}
