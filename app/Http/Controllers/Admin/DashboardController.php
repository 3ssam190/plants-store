<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\User;
use App\Models\Order;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    // app/Http/Controllers/Admin/DashboardController.php
    public function index()
    {
        return view('admin.dashboard', [
            'plantCount' => Plant::count(),
            'userCount' => User::count(),
            'orderCount' => Order::count(),
            'recentActivities' => ActivityLog::latest()->take(5)->get()
        ]);
    }
}