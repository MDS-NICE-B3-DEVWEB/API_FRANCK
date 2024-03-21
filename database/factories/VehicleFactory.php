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
        $carNames = ['1000','L900','5962','2658','R965','26','569','75'];
        $registration = '[A-Z]{2}-[0-9]{2}-[A-Z]{2}-[0-9]{4}';

        return [
            'name' => fake()->randomElement($carNames),
            'registration' => fake()->regexify($registration),
            'status' => fake()->randomElement(['1', '0']),
        ];
    }
}
