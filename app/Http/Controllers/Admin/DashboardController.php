<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Thống kê cơ bản
        $phonesCount = Phone::count();
        $packagesCount = Package::count();
        $usersCount = User::whereHas('role', function ($q) {
            $q->where('name', 'user');
        })->count();
        $employeesCount = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['admin', 'staff']);
        })->count();
        $employees = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['admin', 'staff']);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $totalViews = Phone::sum('views_count');

        // 3. Sản phẩm sắp hết hàng (Tổng tồn kho < 10)
        // Giả sử bạn dùng relation variants, chúng ta dùng having để lọc sau khi sum
        $lowStockPhones = Phone::withSum('variants', 'stock')->having('variants_sum_stock', '<=', 10)->orderBy('variants_sum_stock', 'asc')->take(5)->get();

        // 4. Top 5 sản phẩm xem nhiều
        $topPhones = Phone::with('category')->withSum('variants', 'stock')->orderBy('views_count', 'desc')->take(5)->get();

        // 5. Dữ liệu Chart Category (Lấy các category cấp 2)
        // Cấp 1: parent_id = null -> Cấp 2: parent_id thuộc tập hợp ID cấp 1
        $rootIds = Category::whereNull('parent_id')->pluck('id');
        $categoriesLevel2 = Category::whereIn('parent_id', $rootIds)->get();

        $catNames = $categoriesLevel2->pluck('name');
        $catCounts = $categoriesLevel2->map(fn($c) => Phone::whereIn('category_id', $c->getAllChildIds())->count());

        // 6. Dữ liệu Chart Carrier
        $carrierData = [Package::where('carrier', 'sk')->count(), Package::where('carrier', 'kt')->count(), Package::where('carrier', 'lgu')->count()];

        // Trả về view kèm các biến
        return view('admin.general.dashboard', compact('phonesCount', 'packagesCount', 'usersCount', 'employeesCount', 'totalViews', 'topPhones', 'catNames', 'catCounts', 'carrierData', 'categoriesLevel2', 'employees', 'lowStockPhones'));
    }
}
