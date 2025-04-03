<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Get orders for the authenticated user
        $orders = Order::where('user_id', Auth::id())
                    ->with(['items.product', 'paymentMethod'])
                    ->latest()
                    ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Verify the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Load relationships
        $order->load(['items.product', 'paymentMethod']);

        return view('orders.show', compact('order'));
    }
}