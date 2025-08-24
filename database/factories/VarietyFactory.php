<?php

namespace Database\Factories;

use App\Models\Commodity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variety>
 */
class VarietyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commodity_id' => Commodity::factory(),
            'name' => fake()->firstName(),
            'release_year' => fake()->numberBetween(1980, 2024),
            'potential_yield' => fake()->randomFloat(2, 1.0, 5.0),
            'average_yield' => fake()->randomFloat(2, 0.5, 3.0),
            'maturity_days' => fake()->numberBetween(50, 120),
            'plant_height' => fake()->numberBetween(30, 100),
            'seed_color' => fake()->randomElement(['Kuning', 'Hijau', 'Coklat', 'Merah']),
            'seed_weight' => fake()->randomFloat(2, 2.0, 50.0),
            'protein_content' => fake()->randomFloat(2, 15.0, 45.0),
            'fat_content' => fake()->randomFloat(2, 1.0, 50.0),
            'breeder' => 'Balitkabi',
            'proposer' => 'Kementerian Pertanian',
        ];
    }
}