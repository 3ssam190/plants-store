<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['flower', 'succulent', 'tree']),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'environment' => $this->faker->randomElement(['indoor', 'outdoor']),
        ];
    }
}