@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Complete Your Payment</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill"></i> Please complete your payment within 24 hours to avoid order cancellation.
                    </div>

                    <div class="payment-details mb-4">
                        <h5>Order #{{ $order->id }}</h5>
                        <p class="mb-1"><strong>Amount to Pay:</strong></p>
                        <h3 class="text-success">₱{{ number_format($order->total_amount, 2) }}</h3>
                    </div>

                    <div class="payment-instructions border-top pt-3">
                        <h5><i class="bi bi-qr-code"></i> Payment Options</h5>
                        
                        <!-- GCash Option -->
                        <div class="option-card mb-3 p-3 border rounded">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('images/gcash-logo.png') }}" alt="GCash" width="80" class="me-3">
                                <h5 class="mb-0">GCash Payment</h5>
                            </div>
                            <ol>
                                <li>Open GCash app</li>
                                <li>Tap 'Pay QR'</li>
                                <li>Scan the QR code below</li>
                                <li>Enter exact amount: <strong>₱{{ number_format($order->total_amount, 2) }}</strong></li>
                                <li>Add reference: <code>ORDER-{{ $order->id }}</code></li>
                            </ol>
                            <div class="text-center my-4">
                                <!-- Generate QR code using your preferred method -->
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode('GCashPayment:ORDER-'.$order->id.'|AMOUNT:'.$order->total_amount) }}" 
                                     alt="GCash QR Code" class="img-fluid border p-2">
                            </div>
                        </div>

                        <!-- Manual Payment Reference -->
                        <div class="manual-payment mt-4">
                            <h5><i class="bi bi-receipt"></i> Manual Payment Reference</h5>
                            <p>If you paid via bank transfer or other method:</p>
                            <form action="{{ route('payment.manual.verify') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" name="reference_number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Payment Screenshot</label>
                                    <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Submit Payment Proof
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection