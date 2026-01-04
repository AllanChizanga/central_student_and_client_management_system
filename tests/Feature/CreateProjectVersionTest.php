<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Client;
use App\Livewire\CreateProjectVersionLivewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectVersionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project_version_modal_screen_is_opening()
    {
        Livewire::test(CreateProjectVersionLivewire::class)
            ->assertStatus(200);
    }

    public function test_project_version_is_created_successfully()
    {
        $client = Client::factory()->create();

        $fakeBrd = UploadedFile::fake()->create('brd.pdf', 100, 'application/pdf');
        $fakeContract = UploadedFile::fake()->create('contract.pdf', 100, 'application/pdf');
        $fakeNda = UploadedFile::fake()->create('nda.pdf', 100, 'application/pdf');

        $versionNumber = 1;
        $projectVersionName = 'Version ' . fake()->word();
        $projectProgressStatus = 'mvp_release';
        $startDate = now()->format('Y-m-d H:i:s');
        $endDate = now()->addMonth()->format('Y-m-d H:i:s');
        $sprintDurationDays = 14;
        $hostingAndDomainFee = 1300.00;
        $hasWhatsappIntegration = true;
        $hasAiIntegration = false;
        $hasPaymentsIntegration = true;
        $hasOtherThirdPartyIntegrations = false;
        $maintenanceType = 'monthly';
        $maintenanceFeeMonthly = 165.00;
        $billingType = 'milestone';
        $amount = 8000.00;
        $paid = 3500.00;
        $balance = $amount - $paid;
        $currency = 'USD';

        Livewire::test(CreateProjectVersionLivewire::class)
            ->set('client_id', $client->id)
            ->set('version_number', $versionNumber)
            ->set('project_version_name', $projectVersionName)
            ->set('project_progress_status', $projectProgressStatus)
            ->set('start_date', $startDate)
            ->set('end_date', $endDate)
            ->set('brd_document', $fakeBrd)
            ->set('contract', $fakeContract)
            ->set('nda', $fakeNda)
            ->set('sprint_duration_days', $sprintDurationDays)
            ->set('hosting_and_domain_fee', $hostingAndDomainFee)
            ->set('has_whatsapp_integration', $hasWhatsappIntegration)
            ->set('has_ai_integration', $hasAiIntegration)
            ->set('has_payments_integration', $hasPaymentsIntegration)
            ->set('has_other_third_party_integrations', $hasOtherThirdPartyIntegrations)
            ->set('maintenance_type', $maintenanceType)
            ->set('maintenance_fee_monthly', $maintenanceFeeMonthly)
            ->set('billing_type', $billingType)
            ->set('amount', $amount)
            ->set('paid', $paid)
            ->set('balance', $balance)
            ->set('currency', $currency)
            ->call('create_project_version');

        // Assert project version is created in the database
        $this->assertDatabaseHas('project_versions', [
            'client_id' => $client->id,
            'version_number' => $versionNumber,
            'project_version_name' => $projectVersionName,
            'project_progress_status' => $projectProgressStatus,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'sprint_duration_days' => $sprintDurationDays,
            'hosting_and_domain_fee' => $hostingAndDomainFee,
            'has_whatsapp_integration' => $hasWhatsappIntegration,
            'has_ai_integration' => $hasAiIntegration,
            'has_payments_integration' => $hasPaymentsIntegration,
            'has_other_third_party_integrations' => $hasOtherThirdPartyIntegrations,
            'maintenance_type' => $maintenanceType,
            'maintenance_fee_monthly' => $maintenanceFeeMonthly,
            'billing_type' => $billingType,
            'amount' => $amount,
            'paid' => $paid,
            'balance' => $balance,
            'currency' => $currency,
        ]);
    }
}
