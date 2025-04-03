@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
            <p><strong>Payment Method:</strong> {{ $order->paymentMethod->name ?? 'N/A' }}</p>
            
            <h3 class="mt-4">Items</h3>
            <table class="table">
                <!-- Items table content -->
            </table>
        </div>
    </div>
</div>
@endsection