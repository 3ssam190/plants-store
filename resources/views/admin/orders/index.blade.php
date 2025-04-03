@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Orders</h1>
    <div class="list-group">
        @foreach ($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="list-group-item list-group-item-action">
                Order #{{ $order->id }} - {{ $order->created_at->format('M d, Y') }}
                <span class="badge bg-primary float-end">
                    {{ $order->payment_status }}
                </span>
            </a>
        @endforeach
    </div>
    {{ $orders->links() }}
</div>
@endsection