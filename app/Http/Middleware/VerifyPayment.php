<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;

class VerifyPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the order ID from route parameters
        $orderId = $request->route('order');
        
        // Find the order or fail
        $order = Order::findOrFail($orderId);
        
        // Check if payment is verified
        if (!$order->payment_verified) {
            return redirect()->route('payment.pending', ['order' => $orderId])
                 ->with('error', 'Please complete your payment first');
        }

        return $next($request);
    }
}