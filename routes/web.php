<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SimController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Thùng rác và khôi phục Category
    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // Route resource chuẩn
    Route::resource('categories', CategoryController::class);

    Route::get('/trash', [PhoneController::class, 'trash'])->name('phones.trash');

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
});

// Hiển thị form đăng nhập
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/header', function () {
    return view('client.partials.header');
});