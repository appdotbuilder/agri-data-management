<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pest>
 */
class PestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['pest', 'disease']);
        
        return [
            'name' => fake()->words(3, true),
            'type' => $type,
            'target_plants' => 'Kedelai, Kacang Tanah, Kacang Hijau',
            'symptoms' => fake()->paragraph(),
            'cultural_control' => fake()->paragraph(),
            'physical_control' => fake()->paragraph(),
            'chemical_control' => fake()->paragraph(),
            'biological_control' => fake()->paragraph(),
        ];
    }
}