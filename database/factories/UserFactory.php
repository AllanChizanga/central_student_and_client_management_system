<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // default password
            'phonenumber' => $this->faker->phoneNumber(),
            'user_type' => $this->faker->randomElement(['student', 'client', 'lead', 'admin', 'superuser']),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
            
    }
}
