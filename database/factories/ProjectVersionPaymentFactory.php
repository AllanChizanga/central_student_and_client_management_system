<?php

namespace Database\Factories;

use App\Models\ProjectVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectVersionPayment>
 */
class ProjectVersionPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_version_id' => ProjectVersion::factory(),
            'previous_balance' => $this->faker->randomFloat(2, 0, 10000),
            'amount_paid' => $this->faker->randomFloat(2, 1, 10000),
            'current_balance' =>$this->faker->randomFloat(2, 1, 10000),
            'next_due_date' => $this->faker->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
            'currency' => 'USD',
            'payment_method' => $this->faker->randomElement(['Ecocash', 'Bank', 'Cash', 'Innbucks', 'Omari', 'Visa', 'Other']),
        ];
    }
}
