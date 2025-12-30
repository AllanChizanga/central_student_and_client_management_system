<?php

namespace Database\Factories;

use App\Models\OperatingExpense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseInstance>
 */
class ExpenseInstanceFactory extends Factory
{
   
    public function definition(): array
    {
        return [
        'operating_expense_id' => OperatingExpense::factory()->create()->id,
        'period' => $this->faker->date('Y-m-01'),
        'amount_due' => $this->faker->randomFloat(2, 10, 2000),
        'amount_paid' => 0,
        'status' => 'pending',
        'due_date' => $this->faker->optional()->date(),
        'paid_at' => null,
        'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
