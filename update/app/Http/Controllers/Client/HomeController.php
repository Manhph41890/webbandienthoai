<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy 10 danh mục ngẫu nhiên
        $categories = Category::inRandomOrder()->take(10)->get();
        $categories_iphone = Category::where('name', 'like', '%iPhone%')->where('name', 'not like', '%Series%')->inRandomOrder()->take(10)->get();

        $categories_samsung = Category::where(function ($query) {
            $query
                ->where('name', 'like', '%Note%')
                ->orWhere('name', 'like', '%S %') // Có dấu cách để tránh lẫn với 'Samsung'
                ->orWhere('name', 'like', '%Z %'); // Có dấu cách để tránh lẫn với 'Zone'
        })
            ->where('name', 'not like', '%iPhone%')
            ->inRandomOrder()
            ->take(5)
            ->get();

        // 2. Lấy danh sách sản phẩm NỔI BẬT (Featured)
        $featuredPhones = Phone::active()
            ->featured() // Chỉ lấy sản phẩm có is_featured = true
            ->whereHas('variants', function ($query) {
                $query->where('status', 'còn_hàng')->where('stock', '>', 0);
            })
            ->withMin('variants as min_price', 'price') // Lấy giá thấp nhất ngay trong SQL
            ->with(['category']) // Chỉ load category, không cần load hết variants
            ->latest()
            ->take(12) // Thường trang chủ lấy 8 hoặc 12 (chia hết cho 4 cột)
            ->get();

        // 3. Top sản phẩm XEM NHIỀU (Dựa trên views_count thay vì random)
        $topSellingPhones = Phone::active()
            ->whereHas('variants', function ($query) {
                $query->where('status', 'còn_hàng');
            })
            ->withMin('variants as min_price', 'price')
            ->mostViewed() // Sắp xếp theo views_count desc (đã viết trong model)
            ->take(8)
            ->get();

        // 4. Lấy danh sách IPHONE CHÍNH HÃNG (Có phân trang)
        // Trong Controller
        $iphones = Phone::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('name', 'like', '%iPhone%');
            })
            ->whereHas('variants', function ($q) {
                $q->where('status', 'còn_hàng');
            })
            ->with([
                'variants' => function ($q) {
                    $q->where('status', 'còn_hàng')->orderBy('price', 'asc');
                },
            ])
            ->latest() // Hoặc inRandomOrder() tùy bạn
            ->get(); // Thay paginate(8) bằng get() để lấy hết

        // 5. Lấy danh sách SAMSUNG (Lấy hết)
        $samsungs = Phone::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('name', 'not like', '%iphone%');
            })
            ->whereHas('variants', function ($q) {
                $q->where('status', 'còn_hàng');
            })
            ->with([
                'variants' => function ($q) {
                    $q->where('status', 'còn_hàng')->orderBy('price', 'asc');
                },
            ])
            ->latest()
            ->get();

        // 6. Lấy danh sách gói cước (Chỉ lấy các gói đang hoạt động)
        $packages = Package::active()->latest()->get();

        return view(
            'home.home',
            compact(
                'featuredPhones',
                'topSellingPhones',
                'categories',
                'categories_iphone',
                'iphones',
                'samsungs',
                'categories_samsung',
                'packages', // Đẩy biến packages ra view
            ),
        );
    }
}
