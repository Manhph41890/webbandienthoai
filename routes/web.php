<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PhoneController;
use App\Http\Controllers\Admin\SimController;
use App\Http\Controllers\Client\PhoneClientController;
use Illuminate\Support\Facades\Route;


// 1. Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Chi tiết sản phẩm (Ưu tiên khớp route này trước)
Route::get('/phone/{slug}', [PhoneClientController::class, 'phoneDetail'])->name('phone.detail');

// 3. Danh mục sản phẩm (Để dưới cùng vì nó khớp với mọi chuỗi sau dấu /)
Route::get('/{slug}', [PhoneClientController::class, 'listByCategory'])->name('category.show');


// Hiển thị form đăng nhập
Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('auth/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');

// Facebook Login
Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Google Login
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/test/page', function () {
    return view('client.desktop.partials.header');
});

Route::prefix('admin')->name('admin.')->group(function () {

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

    Route::patch('phones/{phone}/change-status', [PhoneController::class, 'changeStatus'])
        ->name('phones.changeStatus');

    Route::resource('phones', PhoneController::class)->names('phones');

    Route::patch('packages/{package}/toggle-active', [PackageController::class, 'toggleActive'])
        ->name('packages.toggleActive');

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
