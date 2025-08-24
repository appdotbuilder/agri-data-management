<?php

namespace Database\Factories;

use App\Models\Regency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'regency_id' => Regency::factory(),
            'name' => 'Kecamatan ' . fake()->streetName(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'cropping_index' => fake()->randomFloat(2, 1.0, 3.0),
            'rainy_months' => fake()->numberBetween(6, 12),
            'k_nutrient' => fake()->randomFloat(2, 1.0, 5.0),
            'p_nutrient' => fake()->randomFloat(2, 0.5, 2.5),
            'c_nutrient' => fake()->randomFloat(2, 1.5, 3.5),
            'cation_exchange_capacity' => fake()->randomFloat(2, 2.0, 6.0),
        ];
    }
}