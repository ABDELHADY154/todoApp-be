<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => "admin",
                'email' => "admin@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make("123123123"), // password
                'remember_token' => Str::random(10),
            ]
        );

        User::factory(10)->create();
    }
}
