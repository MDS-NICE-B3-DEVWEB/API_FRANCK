<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FDR>
 */
class FDRFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'id_agency' => fake()->numberBetween(1, 10),
            'id_vehicle' => fake()->numberBetween(1, 10),
            'id_agent' => fake()->numberBetween(1, 10),
            'tonnage' => fake()->numberBetween(10, 20),
            'id_user' => fake()->numberBetween(1, 3),
        ];
    }
}
