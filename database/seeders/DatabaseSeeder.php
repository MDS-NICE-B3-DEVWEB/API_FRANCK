<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        \App\Models\User::create([
            'username' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Azertyuiop9!'),
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(2)->create();

        \App\Models\Agency::factory(5)->create();

        \App\Models\Agent::factory(10)->create();

        \App\Models\Vehicle::factory(10)->create();

        \App\Models\FDR::factory(5)->create();

    }
}
