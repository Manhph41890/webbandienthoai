<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PhoneController;
use App\Http\Controllers\Client\PackageClientController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\PhoneClientController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\HTTPStatusController;
use App\Http\Controllers\MessengerTrackingController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. GUEST ROUTES (Ai cũng có thể truy cập)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search/products', [SearchController::class, 'index'])->name('search');

// Route liên hệ cho khách
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

// Route Gói cước (Client)
Route::get('/goi-cuoc/{slug}', [PackageClientController::class, 'listByCategory'])->name('package.category');
Route::get('/chi-tiet-goi/{slug}', [PackageClientController::class, 'detail'])->name('package.detail');

// Route Sản phẩm & Danh mục (Để cuối để tránh đè route khác)
Route::get('/phone/{slug}', [PhoneClientController::class, 'phoneDetail'])->name('phone.detail');
Route::get('/{slug}', [PhoneClientController::class, 'listByCategory'])->name('category.show');

Route::get('toanhongkorea/404', [HTTPStatusController::class, 'http404'])->name('404');
Route::get('toanhongkorea/403', [HTTPStatusController::class, 'http403'])->name('403');

// Wishlist web ưu tiên không cần đăng nhập
Route::get('/wishlist/list', [FavoriteController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/toggle', [FavoriteController::class, 'toggle'])->name('wishlist.toggle');

Route::post('/track-messenger-click', [MessengerTrackingController::class, 'trackClick'])->name('track.messenger');

Route::get('pages/chinh-sach-bao-mat', [PageController::class, 'privacy'])->name('privacy');
Route::get('pages/dieu-khoan-su-dung', [PageController::class, 'terms'])->name('terms');

/*
|--------------------------------------------------------------------------
| 2. AUTH ROUTES (Đăng nhập, đăng ký, social)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login');
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register');
        Route::post('logout', 'logout')->name('logout')->middleware('auth');

        // Social Login
        Route::get('facebook', 'redirectToFacebook')->name('facebook.login');
        Route::get('facebook/callback', 'handleFacebookCallback');
        Route::post('/delete-user-data', [AuthController::class, 'deleteFacebookData']);
        Route::get('google', 'redirectToGoogle')->name('google.login');
        Route::get('google/callback', 'handleGoogleCallback');
    });

/*
|--------------------------------------------------------------------------
| 3. USER PROTECTED ROUTES (Cần đăng nhập - Cho cả 3 Roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile cá nhân
    Route::get('/profile/user', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/read/{userId}', [ChatController::class, 'markAsRead']);
});
/*
|--------------------------------------------------------------------------
| 4. ADMIN & STAFF ROUTES (Roles 1 & 2)
|--------------------------------------------------------------------------
| Nhóm này dành cho Quản trị viên và Nhân viên cùng quản lý nội dung
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:1,2']) // Chỉ Role 1 (Quản trị) và 2 (Nhân viên)
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Quản lý Liên hệ (Admin side)
        Route::get('/lien-he', [ContactController::class, 'getContact'])->name('contact.index');
        Route::post('/lien-he/{id}/phan-hoi', [ContactController::class, 'replyMail'])->name('contacts.reply');

        // --- Quản lý Danh mục (Categories) ---
        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::resource('categories', CategoryController::class);

        // --- Quản lý Điện thoại (Phones) ---
        Route::get('phones/trash', [PhoneController::class, 'trash'])->name('phones.trash');
        Route::patch('phones/{id}/restore', [PhoneController::class, 'restore'])->name('phones.restore');
        Route::delete('phones/{id}/force-delete', [PhoneController::class, 'forceDelete'])->name('phones.forceDelete');
        Route::get('phones/get-variant-form-fields', [PhoneController::class, 'getVariantFormFields'])->name('phones.getVariantFormFields');
        Route::patch('phones/{phone}/change-status', [PhoneController::class, 'changeStatus'])->name('phones.changeStatus');
        Route::patch('/phones/{phone}/toggle-featured', [PhoneController::class, 'toggleFeatured'])->name('phones.toggle-featured');
        Route::resource('phones', PhoneController::class);

        // --- Quản lý biến thể
        Route::resource('colors', ColorController::class)->except(['create', 'show', 'edit']); 
        Route::resource('sizes', SizeController::class)->except(['create', 'show', 'edit']);

        // --- Quản lý Gói cước (Packages) ---
        Route::get('packages/trash', [PackageController::class, 'trash'])->name('packages.trash');
        Route::post('packages/{id}/restore', [PackageController::class, 'restore'])->name('packages.restore');
        Route::delete('packages/{id}/force-delete', [PackageController::class, 'forceDelete'])->name('packages.forceDelete');
        Route::patch('packages/{package}/toggle-active', [PackageController::class, 'toggleActive'])->name('packages.toggleActive');
        Route::resource('packages', PackageController::class);

        /*
        |--------------------------------------------------------------------------
        | 5. ONLY ADMIN ROUTES (Role 1 Only)
        |--------------------------------------------------------------------------
        | Chỉ Quản trị viên tối cao mới có quyền quản lý Tài khoản/Nhân viên
        */
        Route::middleware(['role:1'])->group(function () {
            Route::get('users', [AccountController::class, 'indexUsers'])->name('accounts.users.index');
            Route::patch('accounts/{account}/toggle-status', [AccountController::class, 'toggleStatus'])->name('accounts.toggleStatus');
            Route::resource('accounts', AccountController::class);
        });
    });
