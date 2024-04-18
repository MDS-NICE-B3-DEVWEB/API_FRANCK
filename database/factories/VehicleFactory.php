<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carNames = '[A-Z]{1}[0-9]{4}';
        $registration = '[A-Z]{2}-[0-9]{2}-[A-Z]{2}-[0-9]{4}';

        return [
            'name' => fake()->regexify($carNames),
            'registration' => fake()->regexify($registration),
            'status' => fake()->randomElement(['1', '0']),
        ];
    }
}
