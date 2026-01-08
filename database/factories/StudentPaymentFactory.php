<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentPayment>
 */
class StudentPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number'    => $this->faker->unique()->numberBetween(10000, 99999),
            'enrollment_id'     => Enrollment::factory()->create()->id,
            'previous_balance'  => $this->faker->randomFloat(2, 0, 1000),
            'amount_paid'       => $this->faker->randomFloat(2, 10, 1000),
            'current_balance'   => $this->faker->randomFloat(2, 0, 1000),
            'next_due_date'     => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'currency'          => 'USD',
            'payment_method'    => $this->faker->randomElement(['Ecocash', 'Bank', 'Cash', 'Innbucks', 'Omari', 'Visa', 'Other']),
        ];
    }
}
