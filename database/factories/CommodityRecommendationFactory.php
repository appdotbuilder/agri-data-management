<?php

namespace Database\Factories;

use App\Models\Commodity;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommodityRecommendation>
 */
class CommodityRecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => District::factory(),
            'commodity_id' => Commodity::factory(),
            'productivity' => fake()->randomFloat(2, 0.5, 3.0),
            'improvement_potential' => fake()->randomFloat(2, 0.1, 2.0),
            'potential_value' => fake()->randomFloat(2, 1000000, 50000000),
        ];
    }
}