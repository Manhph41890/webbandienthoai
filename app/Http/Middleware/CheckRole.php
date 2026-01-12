<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập trước.');
        }

        // 2. Lấy role_id của user hiện tại
        $userRoleId = Auth::user()->role_id;

        // 3. Kiểm tra xem role của user có nằm trong danh sách cho phép không
        // Các tham số truyền vào từ route sẽ nằm trong mảng $roles
        if (in_array($userRoleId, $roles)) {
            return $next($request);
        }

        // Nếu không có quyền, trả về lỗi 403 hoặc chuyển hướng
        // abort(403, 'Bạn không có quyền truy cập trang này.');
        return redirect()->route('403');
    }
}
