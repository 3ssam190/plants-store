<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plant;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'plants' => Plant::count(),
            'orders' => Order::where('status', 'completed')->count(),
            'users' => User::where('is_admin', false)->count(),
            'revenue' => Order::where('status', 'completed')->sum('total')
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}