<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('payment_method_id')->constrained();
        $table->string('payment_status')->default('pending'); // pending/paid/confirmed/cancelled
        $table->timestamp('paid_at')->nullable();
        $table->boolean('requires_payment_verification')->default(false);
        $table->decimal('total_amount', 10, 2);
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
