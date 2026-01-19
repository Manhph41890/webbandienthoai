<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MessengerOrder;
use App\Models\Package;
use App\Models\Phone;
use App\Models\User;
use App\Models\Variant;
use App\Models\VisitorStatistic;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = null;
        $endDate = now()->endOfDay();
        $range = $request->input('time_range', 'all'); // Mặc định tháng này

        // 1. Ưu tiên kiểm tra nếu có chọn ngày tùy chỉnh
        if ($request->filled('from_date') || $request->filled('to_date')) {
            $range = 'custom'; // Đánh dấu là đang dùng tùy chỉnh
            $startDate = $request->filled('from_date') ? \Carbon\Carbon::parse($request->from_date)->startOfDay() : now()->parse('2020-01-01'); // Hoặc ngày bắt đầu hệ thống

            if ($request->filled('to_date')) {
                $endDate = \Carbon\Carbon::parse($request->to_date)->endOfDay();
            }
        }
        // 2. Nếu không có ngày tùy chỉnh, mới xét đến dropdown
        else {
            switch ($range) {
                case 'today':
                    $startDate = now()->startOfDay();
                    break;
                case 'year':
                    $startDate = now()->startOfYear();
                    break;
                case 'all':
                    $startDate = now()->parse('2020-01-01');
                    break;
                case 'month':
                default:
                    $startDate = now()->startOfMonth();
                    break;
            }
        }

        // Hàm helper để áp dụng filter thời gian (tránh lặp code)
        $applyFilter = function ($query) use ($startDate, $endDate) {
            if ($startDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            return $query;
        };

        // 2. Thống kê theo khoảng thời gian
        // CỘT 1: Tổng số lượng biến thể (Variants) và Tổng kho
        $totalVariants = Variant::count();
        $totalStock = Variant::sum('stock'); // Tổng tất cả máy trong kho

        // CỘT 2: Gói cước (giữ nguyên)
        $packagesCount = $applyFilter(Package::query())->count();

        // CỘT 3: Nhân sự & Khách hàng (giữ nguyên hoặc tối ưu)
        $usersCount = User::whereHas('role', fn($q) => $q->where('name', 'Khách hàng'))->when($startDate, fn($q) => $q->whereBetween('created_at', [$startDate, $endDate]))->count();
        $employeesCount = User::whereHas('role', fn($q) => $q->whereIn('name', ['Quản trị viên', 'Nhân viên']))->count();

        // CỘT 4: Tổng lượt xem sản phẩm (Sử dụng SUM views_count)
        $totalProductViews = Phone::sum('views_count');

        // --- CỘT 5: THỐNG KÊ ĐƠN QUA MESSENGER ---
        // Sử dụng $applyFilter đã có của bạn để lọc theo ngày tháng
        $messengerQuery = MessengerOrder::query();
        $messengerQuery = $applyFilter($messengerQuery);

        // 1. Tổng số lượt nhấn mua (Total)
        $totalMessengerOrders = (clone $messengerQuery)->count();

        // 2. Doanh thu dự tính (Tổng giá trị các sản phẩm khách đã nhấn)
        $totalMessengerRevenue = (clone $messengerQuery)->sum('price');

        // 3. Phân loại đơn (Để hiển thị chi tiết trong collapse)
        $phoneMessCount = (clone $messengerQuery)->phones()->count();
        $packageMessCount = (clone $messengerQuery)->packages()->count();

        // CỘT 6: Tổng lượt truy cập Website
        // Lưu ý: Vì bảng visitor_statistics dùng cột 'date', ta filter theo cột đó thay vì 'created_at'
        $webStats = VisitorStatistic::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->get();

        $mobileHits = $webStats->where('device_type', 'mobile')->sum('hits');
        $desktopHits = $webStats->where('device_type', 'desktop')->sum('hits');
        $webVisits = $mobileHits + $desktopHits;

        // Tính phần trăm để hiển thị
        $mobileRate = $webVisits > 0 ? round(($mobileHits / $webVisits) * 100) : 0;
        $desktopRate = $webVisits > 0 ? round(($desktopHits / $webVisits) * 100) : 0;

        // CỘT 7: Sản phẩm yêu thích (Engagement)
        $totalFavorites = \DB::table('favorites')->count();

        // CỘT 8: Tỷ lệ chuyển đổi hoặc Sản phẩm sắp hết hàng
        $outOfStockCount = Variant::where('stock', '<=', 5)->count();

        // 3. Các dữ liệu thời điểm (Không lọc theo range)
        $employeesCount = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['Quản trị viên', 'Nhân viên']);
        })->count();

        $employees = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['Quản trị viên', 'Nhân viên']);
            })
            ->where('last_seen_at', '>=', now()->subMinutes(5))
            ->orderBy('last_seen_at', 'desc')
            ->take(10)
            ->get();

        $totalViews = Phone::sum('views_count');

        // 4. Sản phẩm & Top (Giữ nguyên logic của bạn)
        $lowStockPhones = Phone::withSum('variants', 'stock')->having('variants_sum_stock', '<=', 10)->orderBy('variants_sum_stock', 'asc')->take(5)->get();

        $topPhones = Phone::with('category')->withSum('variants', 'stock')->orderBy('views_count', 'desc')->take(5)->get();

        // 5. Dữ liệu Chart Category
        $rootIds = Category::whereNull('parent_id')->pluck('id');
        $categoriesLevel2 = Category::whereIn('parent_id', $rootIds)->get();

        $catNames = $categoriesLevel2->pluck('name');
        $catCounts = $categoriesLevel2->map(function ($c) use ($applyFilter) {
            return $applyFilter(Phone::whereIn('category_id', $c->getAllChildIds()))->count();
        });

        // 6. Dữ liệu Chart Carrier
        $carriers = ['sk', 'kt', 'lgu'];
        $carrierData = [];
        foreach ($carriers as $carrier) {
            $carrierData[] = $applyFilter(Package::where('carrier', $carrier))->count();
        }
        return view(
            'admin.general.dashboard',
            compact(
                // 1. Thông tin bộ lọc (Để hiển thị lại trên Form)
                'startDate',
                'endDate',
                'range',

                // 2. Thống kê kho hàng & Sản phẩm
                'totalVariants',
                'totalStock',
                'outOfStockCount',
                'lowStockPhones',
                'topPhones',
                'totalProductViews', // Thay cho totalViews vì giống nhau

                // 3. Gói cước & Đơn hàng Messenger (Phần bạn đã tính nhưng thiếu trong compact cũ)
                'packagesCount',
                'totalMessengerOrders',
                'totalMessengerRevenue',
                'phoneMessCount',
                'packageMessCount',

                // 4. Người dùng & Nhân sự
                'usersCount',
                'employeesCount',
                'employees',
                'totalFavorites',

                // 5. Thống kê truy cập Web
                'webVisits',
                'mobileHits',
                'desktopHits',
                'mobileRate',
                'desktopRate',

                // 6. Dữ liệu biểu đồ (Charts)
                'catNames',
                'catCounts',
                'carrierData',
                'categoriesLevel2',
            ),
        );
    }
}