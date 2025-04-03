<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('payment_verified')->default(false)->after('total_amount');
            $table->string('payment_method')->nullable()->after('payment_verified');
            $table->timestamp('payment_date')->nullable()->after('payment_method');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_verified', 'payment_method', 'payment_date']);
        });
    }
};