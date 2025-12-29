<?php

namespace Database\Factories;

use App\Models\ProjectVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMilestone>
 */
class ProjectMilestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'project_version_id' => ProjectVersion::factory()->create()->id,
        'title' => $this->faker->sentence(3),
        'deliverables' => $this->faker->paragraph(),
        'duration_days' => $this->faker->numberBetween(1, 30),
        'amount' => $this->faker->randomFloat(2, 100, 10000),
        'payment_status' => $this->faker->randomElement(['pending', 'paid', 'overdue']),
        'due_date' => $this->faker->date(),
        'developers_notes' => $this->faker->paragraph(),
        ];
    }
}
