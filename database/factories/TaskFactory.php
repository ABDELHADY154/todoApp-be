<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "client_id" => rand(1, Client::all()->count()),
            "summary" => fake()->jobTitle,
            "desc" => fake()->text(250),
            "due_date" => fake()->dateTime,
            "completed" => rand(0, 1),
        ];
    }
}
