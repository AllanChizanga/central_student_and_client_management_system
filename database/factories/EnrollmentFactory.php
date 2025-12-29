<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Intake;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'student_id' => Student::factory()->create()->id,
        'course_id' => Course::factory()->create()->id,
        'intake_id' => Intake::factory()->create()->id,
        'enrollment_date' => $this->faker->date(),
        'status' => $this->faker->randomElement(['enrolled', 'graduated', 'dropped']),
        'amount' => $this->faker->randomFloat(2, 1000, 5000),
        'paid' => function (array $attributes) {
            // Ensure paid is less than or equal to amount
            return $this->faker->randomFloat(2, 0, $attributes['amount']);
        },
        'balance' => function (array $attributes) {
            return round($attributes['amount'] - $attributes['paid'], 2);
        },
        'currency' => $this->faker->randomElement(['USD', 'ZWL']),
        ];
    }
}
