<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => $this->faker->unique()->words(3, true),
        'category' => $this->faker->randomElement([
            'Software Engineering',
            'Cybersecurity',
            'Artificial Intelligence',
        ]),
        'active' => $this->faker->boolean(),
        'duration_months' => $this->faker->numberBetween(1, 48),
        'mode_of_learning' => $this->faker->randomElement([
            'Evening Online',
            'Day In Person',
            'Evening In Person',
            'Weekend In Person',
            'Online Self Paced',
        ]),
        'total_fee' => $this->faker->randomFloat(2, 100, 20000),
        'fee_currency' => $this->faker->randomElement(['USD', 'ZWL']),
        'monthly_fee' => $this->faker->randomFloat(2, 10, 2000),
        'syllabus_pdf' => $this->faker->uuid . '.pdf',
        'summary' => $this->faker->text(300),
        'prerequisites' => $this->faker->text(100),
        'weekly_schedule' => $this->faker->sentence(8),
        'grading' => $this->faker->text(120),
        'type_of_assessments' => $this->faker->text(100),
        ];
    }
}
