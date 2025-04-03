<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\OrderPaymentVerified;
use App\Mail\OrderPaymentRejected;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function pending(Order $order)
    {
        if (!in_array($order->payment_status, ['pending', 'under_review'])) {
            return redirect()->route('orders.show', $order);
        }

        return view('payment.pending', compact('order'));
    }

    public function rejected(Order $order)
    {
        if ($order->payment_status !== 'rejected') {
            return redirect()->route('orders.show', $order);
        }

        return view('payment.rejected', compact('order'));
    }

    public function success(Order $order)
    {
        if ($order->payment_status !== 'confirmed') {
            return redirect()->route('orders.show', $order);
        }

        return view('payment.success', compact('order'));
    }

    public function verifyManual(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'reference_number' => 'required|string|max:50',
            'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:2048'
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Store payment proof
        $path = $request->file('payment_proof')->store('payment-proofs');

        $order->update([
            'payment_proof' => $path,
            'reference_number' => $validated['reference_number'],
            'payment_status' => 'under_review'
        ]);

        return redirect()->route('payment.pending', $order)
            ->with('success', 'Payment proof submitted for verification');
    }
}