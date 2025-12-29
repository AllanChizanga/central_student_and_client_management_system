<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ProjectVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qoutation>
 */
class QoutationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'client_id' => Client::factory()->create()->id,
        'project_version_id' => ProjectVersion::factory()->create()->id,
        'qoute_id' => $this->faker->uuid(),
        'description' => $this->faker->paragraph(),
        'total_amount' => $this->faker->randomFloat(2, 1000, 100000),
        'status' => $this->faker->randomElement(['draft', 'sent', 'accepted', 'rejected', 'expired']),
        'valid_until' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
