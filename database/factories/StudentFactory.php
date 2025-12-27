<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{ 

    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'student_number' => $this->faker->unique()->numerify('SN######'),
            'enrollment_status' => 'enrolled',
            'admission_date' => $this->faker->date(),
            'graduation_date' => null, // match migration: nullable by default, leave as null in factory
            'gender' => $this->faker->optional()->randomElement(['male', 'female']), // migration restricts to 'male' or 'female'
            'address' => $this->faker->optional()->streetAddress(),
            'city' => $this->faker->optional()->city(),
        ];
    }
}
