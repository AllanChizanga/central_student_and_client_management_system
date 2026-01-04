<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectVersion>
 */
class ProjectVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'version_number' => $this->faker->numberBetween(1, 20),
            'client_id' => Client::factory()->create()->id,
            'project_version_name' => $this->faker->text(20),
            'project_progress_status' => $this->faker->randomElement([
                'backlog_development',         // Product Backlog Development – planning and requirements gathering
                'backlog_review',              // Product Backlog Review Meeting – stakeholder approval/refinement
                'sprint_development',          // Sprint Development – active development of features
                'mvp_release',                 // MVP Release – first usable version of the product
                'production',                  // System in Production – product is live and actively used by clients
                'maintenance_mode',            // Maintenance Mode – post-release support, bug fixes, updates
            ]),
            'start_date' => now(),
            'end_date' => now()->addMonths(4),
            'brd_document' => $this->faker->url(),
            'contract' => $this->faker->url(),
            'nda' => $this->faker->url(),
            'quotation_id' => null,
            'sprint_duration_days' => $this->faker->randomElement([7, 14, 21, 28]),
            'hosting_and_domain_fee' => $this->faker->randomFloat(2, 0, 500),
            'has_whatsapp_integration' => $this->faker->boolean(),
            'has_ai_integration' => $this->faker->boolean(),
            'has_payments_integration' => $this->faker->boolean(),
            'has_other_third_party_integrations' => $this->faker->boolean(),
            'maintenance_type' => $this->faker->randomElement(['on_call','monthly']),
            'maintenance_fee_monthly' => $this->faker->randomFloat(2, 0, 300),
            'billing_type' => $this->faker->randomElement(['milestone', 'fortnightly']),
            'amount' => $this->faker->randomFloat(2, 100, 100_000),
            'paid' => $this->faker->randomFloat(2, 0, 100_000),
            'balance' => $this->faker->randomFloat(2, 0, 100_000),
            'currency' => $this->faker->randomElement(['USD']),
        ];
    }
}
