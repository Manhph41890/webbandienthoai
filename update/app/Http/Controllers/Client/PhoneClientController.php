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
        $currentCategory = Category::where('slug', $slug)->active()->with('children')->firstOrFail();
        $categoryIds = $currentCategory->getAllChildIds();
        $isIphone = \Illuminate\Support\Str::contains(strtolower($currentCategory->name), 'iphone');

        $query = Phone::whereIn('category_id', $categoryIds)->active()->join('variants', 'phones.id', '=', 'variants.phone_id')->select('phones.*', DB::raw('MIN(variants.price) as min_price'))->groupBy(
            'phones.id',
            'phones.category_id',
            'phones.name',
            'phones.slug',
            'phones.short_description',
            'phones.is_active', // Phải khớp với Model và DB
            'phones.main_image',
            'phones.views_count', // Đồng nhất tên cột
            'phones.is_featured',
            'phones.created_at',
            'phones.updated_at',
            'phones.deleted_at',
        );

        // Filter: Price
        if ($request->filled('price_range')) {
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

        // Filter: Featured
        if ($request->has('is_featured')) {
            $query->featured();
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('min_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('min_price', 'desc');
                break;
            case 'popular':
                $query->orderBy('phones.views_count', 'desc');
                break; // Dùng views_count
            case 'oldest':
                $query->orderBy('phones.created_at', 'asc');
                break;
            default:
                $query->orderBy('phones.created_at', 'desc');
                break;
        }

        $iphones = $query
            ->with(['category', 'variants'])
            ->paginate(24)
            ->withQueryString();
        $categories_iphone = $currentCategory->children()->active()->ordered()->get();

        return view('phones.categories.phone-list', compact('iphones', 'currentCategory', 'categories_iphone', 'isIphone'));
    }

    public function phoneDetail($slug)
    {
        $phone = Phone::where('slug', $slug)
            ->active()
            ->with(['category', 'images', 'variants.color', 'variants.size'])
            ->firstOrFail();

        $phone->incrementView();

        $allImages = collect([$phone->main_image])
            ->concat($phone->images->pluck('image_path'))
            ->concat($phone->variants->pluck('image_path'))
            ->filter()
            ->unique();

        $parentId = $phone->category->parent_id ?? $phone->category_id;
        $categoryIds = Category::where('parent_id', $parentId)->orWhere('id', $parentId)->pluck('id');

        $relatedPhones = Phone::whereIn('category_id', $categoryIds)
            ->where('id', '!=', $phone->id)
            ->active()
            ->with(['variants'])
            ->limit(4)
            ->get();

        $variants = $phone->variants;
        $availableConditions = $variants->pluck('condition')->unique()->values();
        $availableSizes = $variants->pluck('size')->unique('id')->values();
        $availableColors = $variants->pluck('color')->unique('id')->values();
        $isIphone = \Illuminate\Support\Str::contains(strtolower($phone->name), 'iphone');

        return view('phones.phone-detail', compact('phone', 'variants', 'isIphone', 'availableConditions', 'availableSizes', 'availableColors', 'allImages', 'relatedPhones'));
    }
}
