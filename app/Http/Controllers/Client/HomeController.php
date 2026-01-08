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

        // 2. Lấy danh sách sản phẩm NỔI BẬT
        // Điều kiện: Phone phải is_active = true VÀ có ít nhất một Variant có status = 'còn_hàng'
        $featuredPhones = Phone::where('is_active', true)
            ->whereHas('variants', function ($query) {
                $query->where('status', 'còn_hàng'); // Chỉ lấy Phone có biến thể còn hàng
            })
            ->with([
                'variants' => function ($query) {
                    $query
                        ->where('status', 'còn_hàng') // Chỉ load các biến thể còn hàng lên view
                        ->orderBy('price', 'asc'); // Sắp xếp để lấy giá thấp nhất làm giá đại diện
                },
            ])
            ->latest()
            ->take(20)
            ->get();

        // 3. Top sản phẩm XEM NHIỀU (Top Selling)
        // Điều kiện: Phone is_active = true VÀ Variant status = 'còn_hàng'
        $topSellingPhones = Phone::where('is_active', true)
            ->join('variants', 'phones.id', '=', 'variants.phone_id')
            ->where('variants.status', 'còn_hàng') // Chỉ tính lượt view của các biến thể đang hoạt động
            ->select('phones.*', DB::raw('SUM(variants.view) as total_views')) // Sử dụng cột 'view' như bạn mô tả
            ->groupBy('phones.id', 'phones.category_id', 'phones.name', 'phones.slug', 'phones.short_description', 'phones.is_active', 'phones.main_image', 'phones.created_at', 'phones.updated_at', 'phones.deleted_at')
            ->orderBy('total_views', 'asc')
            ->with([
                'variants' => function ($query) {
                    $query->where('status', 'còn_hàng'); // Chỉ load các biến thể còn hàng
                },
            ])
            ->inRandomOrder()
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
