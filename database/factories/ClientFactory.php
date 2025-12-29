<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => User::factory()->create()->id,
        'company_name' => $this->faker->company(),
        'industry' => $this->faker->randomElement([
            'Information Technology', 'Finance', 'Healthcare', 'Education', 'Retail', 'Manufacturing', 'Construction', 'Consulting'
        ]),
        'lifetime_revenue_contribution' => $this->faker->randomFloat(2, 1000, 500000),
        'country' => $this->faker->country(),
        'city' => $this->faker->city(),
        'occupation' => $this->faker->optional()->jobTitle(),
        'address' => $this->faker->optional()->address(),
        'client_type' => $this->faker->randomElement(['individual', 'organization']),
        'client_status' => $this->faker->randomElement(['lead', 'active', 'completed']),
        ];
    }
}
