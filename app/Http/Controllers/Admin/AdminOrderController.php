<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPaymentVerified;
use App\Mail\OrderPaymentRejected;

class AdminOrderController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('payment_status', 'pending')
                             ->where('requires_payment_verification', true)
                             ->with(['user', 'items'])
                             ->latest()
                             ->paginate(10);

        return view('admin.orders.index', compact('pendingOrders'));
    }

    public function pendingPayments()
{
    $orders = Order::where('payment_status', 'under_review')
        ->with(['user', 'paymentMethod'])
        ->paginate(10);

    return view('admin.orders.pending', compact('orders'));
}

public function verifyPayment(Request $request, Order $order)
{
    $validated = $request->validate([
        'action' => 'required|in:approve,reject',
        'notes' => 'nullable|string|max:500'
    ]);

    if ($validated['action'] === 'approve') {
        $order->update([
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);
        
        // Send confirmation email
        Mail::to($order->user->email)->send(new OrderPaymentVerified($order));
        
        return back()->with('success', "Order #{$order->id} payment approved");
    }

    $order->update([
        'payment_status' => 'rejected'
    ]);
    
    Mail::to($order->user->email)->send(new OrderPaymentRejected($order, $validated['notes']));
    
    return back()->with('warning', "Order #{$order->id} payment rejected");
}

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'paymentMethod']);
        
        return view('admin.orders.show', compact('order'));
    }
}