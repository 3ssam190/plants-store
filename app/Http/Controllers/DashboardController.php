<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'plantCount' => Plant::count(), // Simple count of all plants
            'orderCount' => Order::where('user_id', Auth::id())->count(), // User's orders only
        ]);
    }
}