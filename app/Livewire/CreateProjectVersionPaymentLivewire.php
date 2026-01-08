<?php

namespace App\Livewire;

use App\Models\ProjectVersion;
use App\Services\ClientService;
use App\Services\ProjectVersionPaymentService;
use App\Services\ProjectVersionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateProjectVersionPaymentLivewire extends Component
{
    // public attributes
    #[Validate('required|numeric|min:0.01')]
    public $amount;

    #[Validate('required|string|in:Ecocash,Bank,Cash,Innbucks,Omari,Visa,Other')]
    public $payment_method;

    #[Validate('required|date|after_or_equal:today')]
    public $next_due_date;

    // other

    public $project_version;

    // boot
    protected ProjectVersionService $project_version_service;
    protected ProjectVersionPaymentService $project_version_payment_service;
    protected ClientService $client_service;

    public function boot(
        ProjectVersionService $project_version_service,
        ProjectVersionPaymentService $project_version_payment_service,
        ClientService $client_service
    ): void {
        $this->project_version_service = $project_version_service;
        $this->project_version_payment_service = $project_version_payment_service;
        $this->client_service = $client_service;
    }

    // to_array
    public function to_array(): array
    {
        return [
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'next_due_date' => $this->next_due_date,
            'project_version' => $this->project_version,
        ];
    }

   
    // record_payment
    public function record_payment()
    {
        $this->validate();

        // create a new payment
        $response = $this->project_version_payment_service->create($this->to_array());

        if (!$response) {
            session()->flash('error', 'Failed to record project version payment. Please try again.');
        }
        // update project version model
        $response = $this->project_version_service->update_payment($this->project_version, $this->amount);

        if (!$response) {
            session()->flash('error', 'Failed to record project version payment. Please try again.');
        }
        // update client revenue column
        $response = $this->client_service->update_lifetime_revenue_contribution($this->project_version, $this->amount);
        if (!$response) {
            session()->flash('error', 'Failed to record project version payment. Please try again.');
        }

        // generate an invoice
        // feedback
        $this->dispatch('project-version-payment-recorded-successfully');
    }

    // initiate_pay_for_project_version
    #[On('initiate_pay_for_project_version')]
    public function showPaymentModal($project_version_id): void
    {
        $this->project_version = ProjectVersion::find($project_version_id);
        $this->dispatch('view-record-project-version-payment-modal');
    }

    public function render()
    {
        return view('livewire.create-project-version-payment-livewire');
    }
}
