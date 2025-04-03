<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Seeder;

class PlantsTableSeeder extends Seeder
{
    public function run()
{
    // Single manual entry
    \App\Models\Plant::create([
        'name' => 'Snake Plant',
        'type' => 'succulent',
        'price' => 24.99,
        'environment' => 'indoor'
    ]);

    // Factory-generated entries (now works!)
    \App\Models\Plant::factory()->count(10)->create();
}
}