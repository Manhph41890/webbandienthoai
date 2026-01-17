<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Sử dụng View Composer để chia sẻ dữ liệu category cho toàn bộ các view
        // Nếu bạn chỉ muốn chia sẻ cho file header, hãy thay '*' thành 'layouts.header' (tên file blade của bạn)
        View::composer('*', function ($view) {
            $allCategories = Category::active()
                ->ordered()
                ->whereNull('parent_id')
                ->with([
                    'children' => function ($query) {
                        $query
                            ->active()
                            ->ordered()
                            ->with([
                                'children' => function ($q) {
                                    $q->active()->ordered();
                                },
                            ]);
                    },
                ])
                ->get();

            // Tìm category gốc iPhone
            $iphoneRoot = $allCategories->filter(fn($c) => str_contains(strtolower($c->slug), 'iphone'))->first();
            // Truyền CON của nó đi (nếu không có thì truyền collection rỗng)
            $view->with('menuIphones', $iphoneRoot ? $iphoneRoot->children : collect());

            // Tìm category gốc Samsung
            $samsungRoot = $allCategories->filter(fn($c) => str_contains(strtolower($c->slug), 'samsung'))->first();
            $view->with('menuSamsungs', $samsungRoot ? $samsungRoot->children : collect());

            // Với Sim, lấy con của 'goi-cuoc'
            $simRoot = $allCategories->where('slug', 'goi-cuoc')->first();
            $view->with('menuSims', $simRoot ? $simRoot->children : collect());

            $wishlistCount = 0;
            if (auth()->check()) {
                $wishlistCount = Favorite::where('user_id', auth()->id())->count();
            } else {
                $wishlistCount = count(Session::get('favorites', []));
            }
            $view->with('globalWishlistCount', $wishlistCount);
        });
    }
}
