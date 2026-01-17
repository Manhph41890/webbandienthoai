<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class UserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Cập nhật database mỗi 1-5 phút 1 lần để tránh quá tải DB
            $user = Auth::user();
            $user->update(['last_seen_at' => now()]);
        }
        return $next($request);
    }
}
