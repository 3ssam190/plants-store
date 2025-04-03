<div class="payment-options">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <!-- E-Wallet Option -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="payment_method" 
                   id="e-wallet" value="e-wallet" required>
            <label class="form-check-label" for="e-wallet">
                E-Wallet
                <div class="ewallet-logos mt-2">
                    <img src="path/to/paymaya.png" width="60">
                    <img src="path/to/gcash.png" width="60">
                </div>
            </label>
        </div>

        <!-- COD Option -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" 
                   id="cod" value="cash_on_delivery">
            <label class="form-check-label" for="cod">
                Cash on Delivery (Pay when you receive your plants)
            </label>
        </div>

        <button type="submit" class="btn btn-primary mt-4">
            Confirm Order
        </button>
    </form>
</div>