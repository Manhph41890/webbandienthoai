<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PhoneController;
use App\Http\Controllers\Client\PackageClientController;
use App\Http\Controllers\Client\PhoneClientController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// 1. Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(ContactController::class)->group(function () {
    Route::get('/lien-he', 'index')->name('contact.index');
    Route::post('/lien-he', 'store')->name('contact.store');
    Route::get('/admin/lien-he', 'getContact')->name('admin.contact.index');
    Route::post('/admin/lien-he/{id}/phan-hoi', 'replyMail')->name('admin.contacts.reply');
});

// 2. Chi tiết sản phẩm (Ưu tiên khớp route này trước)
Route::get('/phone/{slug}', [PhoneClientController::class, 'phoneDetail'])->name('phone.detail');

// 3. Danh mục sản phẩm (Để dưới cùng vì nó khớp với mọi chuỗi sau dấu /)
Route::get('/{slug}', [PhoneClientController::class, 'listByCategory'])->name('category.show');

// Dành cho gói cước
Route::get('/goi-cuoc/{slug}', [PackageClientController::class, 'listByCategory'])->name('package.category');
Route::get('/chi-tiet-goi/{slug}', [PackageClientController::class, 'detail'])->name('package.detail');

Route::get('/search/products', [SearchController::class, 'index'])->name('search');

Route::get('/wishlist/list', [FavoriteController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/toggle', [FavoriteController::class, 'toggle'])->name('wishlist.toggle');

// Hiển thị form đăng nhập
Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login']);
        Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // Facebook Login
        Route::get('facebook', [AuthController::class, 'redirectToFacebook'])->name('facebook.login');
        Route::get('facebook/callback', [AuthController::class, 'handleFacebookCallback']);
        // Github Login
        // Google Login
        Route::get('google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
    });

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Thùng rác và khôi phục Category
        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

        // Route resource chuẩn
        Route::resource('categories', CategoryController::class);

        Route::get('phones/trash', [PhoneController::class, 'trash'])->name('phones.trash');

        // Khôi phục
        Route::patch('/{id}/restore', [PhoneController::class, 'restore'])->name('phones.restore');

        // Xóa vĩnh viễn
        Route::delete('/{id}/force-delete', [PhoneController::class, 'forceDelete'])->name('phones.forceDelete');
        Route::get('/phones/get-variant-form-fields', [PhoneController::class, 'getVariantFormFields'])->name('phones.getVariantFormFields');

        Route::patch('phones/{phone}/change-status', [PhoneController::class, 'changeStatus'])->name('phones.changeStatus');

        Route::resource('phones', PhoneController::class)->names('phones');

        Route::patch('packages/{package}/toggle-active', [PackageController::class, 'toggleActive'])->name('packages.toggleActive');

        // Các route cho thùng rác phải đặt TRƯỚC resource
        Route::get('packages/trash', [PackageController::class, 'trash'])->name('packages.trash');
        Route::post('packages/{id}/restore', [PackageController::class, 'restore'])->name('packages.restore');
        Route::delete('packages/{id}/force-delete', [PackageController::class, 'forceDelete'])->name('packages.forceDelete');

        // Route Resource chuẩn
        Route::resource('packages', PackageController::class);

        Route::get('users', [AccountController::class, 'indexUsers'])->name('accounts.users.index');
        Route::patch('accounts/{account}/toggle-status', [AccountController::class, 'toggleStatus'])->name('accounts.toggleStatus');
        Route::resource('accounts', AccountController::class);
    });
