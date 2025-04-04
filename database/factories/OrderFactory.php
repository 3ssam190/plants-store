<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 500),
            'status' => 'pending',
            'payment_verified' => false,
            'payment_method' => null,
            'payment_date' => null,
            // Add other required fields
        ];
    }
}