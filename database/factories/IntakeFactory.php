<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intake>
 */
class IntakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'cohort' => $this->faker->unique()->bothify('Cohort ##??'),
        'start_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        'graduation_date' => function (array $attributes) {
            $startDate = $attributes['start_date'] ?? now()->toDateString();
            return Carbon::parse($startDate)->addMonths(rand(3, 24))->format('Y-m-d');
        },
        ];
    }
}
