<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;

// Public Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware('guest:admin')->group(function() {
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login']);
    });
    
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

// Protected Admin Routes
Route::prefix('admin')->middleware(['auth:admin', 'admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('plants', PlantController::class);
    Route::resource('users', UserController::class);
    
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('pending', [OrderController::class, 'pendingPayments'])->name('pending');
        Route::get('{order}', [OrderController::class, 'show'])->name('show');
        Route::post('{order}/verify', [OrderController::class, 'verifyPayment'])->name('verify');
        Route::post('{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
    });
});