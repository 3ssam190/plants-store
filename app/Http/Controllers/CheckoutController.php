<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:e_wallet,cash_on_delivery'
        ]);

        $order = Order::create([
            // ... other order details
            'payment_status' => $request->payment_method === 'cash_on_delivery' ? 'confirmed' : 'pending',
            'requires_payment_verification' => $request->payment_method === 'e_wallet'
        ]);

        if ($request->payment_method === 'e_wallet') {
            return redirect()->route('ewallet.payment', $order);
        }

        // COD - Auto confirm
        return redirect()->route('order.success', $order);
    } 
}
