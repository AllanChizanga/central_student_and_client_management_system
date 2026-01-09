<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\ProjectVersion;
use Illuminate\Foundation\Testing\WithFaker;
use App\Livewire\CreateProjectVersionPaymentLivewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectVersionPaymentTest extends TestCase
{ 

    use RefreshDatabase;

    public function test_create_project_version_payment_modal_screen_is_opening()
    {
        Livewire::test(CreateProjectVersionPaymentLivewire::class)
            ->assertStatus(200);
    }

    public function test_project_version_payment_is_recorded_successfully()
    {
        $project_version = ProjectVersion::factory()->create();
        // Variables
        $amount = 1000.00;
        $payment_method = 'Bank';
        $next_due_date = now()->addDays(30)->format('Y-m-d');

        Livewire::test(CreateProjectVersionPaymentLivewire::class)
            ->set('amount', $amount)
            ->set('payment_method', $payment_method)
            ->set('next_due_date', $next_due_date)
            ->set('project_version', $project_version)
            ->call('record_payment');

        $this->assertDatabaseHas('project_version_payments', [
            'project_version_id' => $project_version->id,
            'amount_paid' => $amount,
            'payment_method' => $payment_method,
            'next_due_date' => $next_due_date,
        ]);
    }
}
