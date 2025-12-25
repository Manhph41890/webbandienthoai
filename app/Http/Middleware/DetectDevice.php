<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\View;
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

        // Kiểm tra nếu không phải là request vào trang admin thì mới xử lý chia giao diện
        if (!$request->is('admin*')) {

            if ($agent->isMobile() && !$agent->isTablet()) {
                // SỬA TẠI ĐÂY: Truy cập vào Finder để prepend đường dẫn
                view()->getFinder()->prependLocation(resource_path('views/client/mobile'));
            } else {
                // SỬA TẠI ĐÂY: Dùng cho desktop
                view()->getFinder()->prependLocation(resource_path('views/client/desktop'));
            }
        }
        // Nếu trên trình duyệt máy tính bạn gõ thêm ?dev=mobile (ví dụ: localhost/?dev=mobile)
        // thì nó sẽ ép hiện giao diện mobile để bạn thiết kế cho tiện.
        if ($request->has('dev') && $request->dev == 'mobile') {
            view()->getFinder()->prependLocation(resource_path('views/client/mobile'));
            return $next($request);
        }

        return $next($request);
    }
}
