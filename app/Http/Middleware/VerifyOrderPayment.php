<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class VerifyOrderPayment
{
    public function handle(Request $request, Closure $next)
    {
        $order = $request->route('order');
        
        if (!$order instanceof Order) {
            $order = Order::findOrFail($order);
        }

        // Allow admin to bypass verification
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        switch ($order->payment_status) {
            case 'pending':
                return redirect()->route('payment.pending', $order)
                    ->with('warning', 'Please complete your payment first');
                
            case 'rejected':
                return redirect()->route('payment.rejected', $order)
                    ->with('error', 'Payment was rejected. Please contact support');
                
            case 'confirmed':
                return $next($request);
                
            default:
                abort(404, 'Order not found');
        }
    }
}