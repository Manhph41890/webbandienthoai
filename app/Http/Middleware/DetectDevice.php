<?php

namespace App\Http\Middleware;

use App\Models\VisitorStatistic;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\View;
use Session;
use Symfony\Component\HttpFoundation\Response;

class DetectDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();

        // 1. Khởi tạo các biến mặc định
        $deviceType = 'desktop';
        $isMobile = false;
        $isIphone = false;
        $isAndroid = false;

        if (!$request->is('admin*')) {
            // 2. Kiểm tra iPhone / Android cụ thể
            // isIphone() và isAndroidOS() là các hàm có sẵn của thư viện Jenssegers\Agent
            $isIphone = $agent->is('iPhone');
            $isAndroid = $agent->isAndroidOS();

            // 2. LOGIC THỐNG KÊ
            $this->trackVisit($deviceType);

            if (($agent->isMobile() && !$agent->isTablet()) || $request->dev == 'mobile') {
                $isMobile = true;
                $deviceType = 'mobile'; // <<--- THÊM DÒNG NÀY
                view()->getFinder()->prependLocation(resource_path('views/client/mobile'));
            } else {
                $deviceType = 'desktop'; // <<--- ĐẢM BẢO LÀ DESKTOP
                view()->getFinder()->prependLocation(resource_path('views/client/desktop'));
            }

            // Bây giờ biến $deviceType đã mang giá trị đúng (mobile hoặc desktop)
            $this->trackVisit($deviceType);
        }

        // 3. CHIA SẺ VỚI TẤT CẢ FILE BLADE
        view()->share('isMobile', $isMobile);
        view()->share('isIphone', $isIphone);
        view()->share('isAndroid', $isAndroid);

        // Bạn cũng có thể chia sẻ tên hệ điều hành nếu muốn dùng linh hoạt hơn
        view()->share('platform', $agent->platform()); // Trả về: iOS, Android, Windows, OS X...

        return $next($request);
    }

    protected function trackVisit($deviceType)
    {
        $today = now()->format('Y-m-d');

        // A. Tăng tổng số lượt truy cập (Page Views) - Mỗi lần load trang là +1
        VisitorStatistic::updateOrCreate(['date' => $today, 'device_type' => $deviceType], ['hits' => \DB::raw('hits + 1')]);

        // B. (Tùy chọn) Tăng số khách duy nhất (Unique Visitors) dựa trên Session
        $sessionKey = 'visited_today_' . $today;
        if (!Session::has($sessionKey)) {
            VisitorStatistic::where('date', $today)->where('device_type', $deviceType)->increment('uniques');

            Session::put($sessionKey, true);
        }
    }
}
