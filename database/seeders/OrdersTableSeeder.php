<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\Order::factory(10)->create([
        'payment_verified' => true,
        'payment_method' => 'credit_card',
        'payment_date' => now()
    ]);
    
    \App\Models\Order::factory(5)->create([
        'payment_verified' => false
    ]);
}
}
