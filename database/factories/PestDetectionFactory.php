<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Pest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PestDetection>
 */
class PestDetectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'district_id' => District::factory(),
            'predicted_pest_id' => Pest::factory(),
            'image_path' => 'pest-detections/' . fake()->uuid() . '.jpg',
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'confidence_score' => fake()->randomFloat(4, 0.1, 1.0),
            'status' => fake()->randomElement(['pending', 'verified', 'rejected']),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}