<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlantController as AdminPlantController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Plants Routes (Public viewing)
Route::resource('plants', PlantController::class)->only(['index', 'show']);

// Authentication Routes
require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Plants management (for regular users)
    Route::resource('plants', PlantController::class)->except(['index', 'show']);
    
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
});