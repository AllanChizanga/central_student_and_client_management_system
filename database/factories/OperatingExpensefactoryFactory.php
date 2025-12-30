<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OperatingExpense>
 */
class OperatingExpensefactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amountType = $this->faker->randomElement(['fixed', 'variable']);
        $defaultAmount = $this->faker->randomFloat(2, 100, 10000);

        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement(['utilities', 'staff', 'marketing', 'infrastructure']),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'yearly']),
            'amount_type' => $amountType,
            'default_amount' => $defaultAmount,
            'vendor' => $this->faker->company(),
            'is_active' => $this->faker->boolean(85),
            'next_due_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
