<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController; // Added this import
use App\Http\Controllers\Admin\PlantController as AdminPlantController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminOrderController;
// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Make sure this comes before your auth routes
Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');

// Plants Routes (Public viewing)
Route::resource('plants', PlantController::class)->only(['index', 'show']);

// Authentication Routes
require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Plants management (for regular users)
    Route::resource('plants', PlantController::class)->except(['index', 'show']);
    
    // Checkout Process
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    });

    // Payment Status
    Route::prefix('payment')->group(function () {
        Route::get('/pending/{order}', [PaymentController::class, 'pending'])
            ->name('payment.pending')
            ->withoutMiddleware('verify.payment');
            
        Route::get('/rejected/{order}', [PaymentController::class, 'rejected'])
            ->name('payment.rejected')
            ->withoutMiddleware('verify.payment');
            
        Route::get('/success/{order}', [PaymentController::class, 'success'])
            ->name('payment.success');
            
        Route::post('/verify-manual', [PaymentController::class, 'verifyManual'])
            ->name('payment.verify.manual');
    });

    // Orders
    Route::middleware('verify.payment')->group(function () {
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
    });
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    
    // Admin Plants management
    Route::resource('plants', AdminPlantController::class)
        ->names('admin.plants');
    
    // Users management
    Route::resource('users', UserController::class)
        ->names('admin.users');
        
    // Order Management
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/pending', [AdminOrderController::class, 'pendingPayments'])->name('admin.orders.pending');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/{order}/verify', [AdminOrderController::class, 'verifyPayment'])->name('admin.orders.verify');
        Route::post('/{order}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
    });
});