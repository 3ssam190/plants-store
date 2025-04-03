<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

// ... rest of your routes
// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Plant Routes
Route::resource('plants', PlantController::class)->only(['index', 'show']);

// Authentication Routes (from auth.php)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->name('logout')
     ->middleware('auth');
    
    // Plants management
    Route::resource('plants', PlantController::class)->except(['index', 'show']);
    
    // Checkout Process
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    });

    // Payment Routes
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

    // Add this with your other routes
Route::prefix('admin')->group(function() {
    Route::get('/login', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'showLoginForm'])
         ->name('admin.login');
         
    Route::post('/login', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'login']);
});
    
    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});