<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


// Admin Category Routes
Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('phones', PhoneController::class)->names('admin.phones');
// Thùng rác
    Route::get('/trash', [PhoneController::class, 'trash'])->name('phones.trash');
    
    // Khôi phục
    Route::patch('/{id}/restore', [PhoneController::class, 'restore'])->name('phones.restore');
    
    // Xóa vĩnh viễn
    Route::delete('/{id}/force-delete', [PhoneController::class, 'forceDelete'])->name('phones.forceDelete');