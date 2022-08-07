<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckIn>
 */
class CheckInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "country" => fake()->country,
            "city" => fake()->city,
            "long" => fake()->longitude,
            "lat" => fake()->latitude,
            "client_id" => rand(1, Client::all()->count())
        ];
    }
}
