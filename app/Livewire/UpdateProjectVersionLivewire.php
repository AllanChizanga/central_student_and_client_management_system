<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\ProjectVersion;
use App\DTOs\ProjectVersionDTO;
use Livewire\Attributes\Validate;
use App\Repositories\ClientRepository;
use App\Services\ProjectVersionService;
use App\Actions\SavePrivateDocumentAction;
use Illuminate\Database\Eloquent\Collection;

class UpdateProjectVersionLivewire extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'uuid', 'exists:clients,id'])]
    public string $client_id;

    #[Validate(['required', 'integer', 'min:1'])]
    public int $version_number;

    #[Validate(['required', 'string', 'max:255'])]
    public string $project_version_name;

    #[Validate(['required', 'string', 'in:backlog_development,backlog_review,sprint_development,mvp_release,production,maintenance_mode'])]
    public string $project_progress_status;

    #[Validate(['required', 'date'])]
    public string $start_date;

    #[Validate(['required', 'date', 'after_or_equal:start_date'])]
    public string $end_date;

    #[Validate(['nullable', 'file', 'max:10240'])]
    public $brd_document;

    #[Validate(['nullable', 'file', 'max:10240'])]
    public $contract;

    #[Validate(['nullable', 'file', 'max:10240'])]
    public $nda;

    #[Validate(['nullable', 'uuid', 'exists:quotations,id'])]
    public ?string $quotation_id = null;

    #[Validate(['required', 'integer', 'min:0'])]
    public int $sprint_duration_days = 0;

    #[Validate(['required', 'numeric', 'min:0'])]
    public float $hosting_and_domain_fee = 0.00;

    #[Validate(['required', 'boolean'])]
    public bool $has_whatsapp_integration = false;

    #[Validate(['required', 'boolean'])]
    public bool $has_ai_integration = false;

    #[Validate(['required', 'boolean'])]
    public bool $has_payments_integration = false;

    #[Validate(['required', 'boolean'])]
    public bool $has_other_third_party_integrations = false;

    #[Validate(['required', 'string', 'in:monthly,on_call'])]
    public string $maintenance_type;

    #[Validate(['required', 'numeric', 'min:0'])]
    public float $maintenance_fee_monthly = 0.00;

    #[Validate(['required', 'string', 'in:milestone,fortnightly'])]
    public string $billing_type;

    #[Validate(['required', 'numeric', 'min:0'])]
    public float $amount = 0.00;

    #[Validate(['required', 'numeric', 'min:0'])]
    public float $paid = 0.00;

    #[Validate(['required', 'numeric', 'min:0'])]
    public float $balance = 0.00;

    #[Validate(['required', 'string', 'max:10'])]
    public string $currency = 'USD';

    public Collection $clients;
    public ProjectVersion $project_version;

    protected ClientRepository $client_repository;
    protected ProjectVersionService $project_version_service;
    protected SavePrivateDocumentAction $save_private_document;

    public function boot(
        ClientRepository $client_repository,
        ProjectVersionService $project_version_service,
        SavePrivateDocumentAction $save_private_document
    ): void {
        $this->client_repository = $client_repository;
        $this->project_version_service = $project_version_service;
        $this->save_private_document = $save_private_document;
    }

    public function save_nda_document(): ?string
    {
        if ($this->nda) {
            return $this->save_private_document->execute('NDAs', $this->nda);
        }

        return null;
    }

    public function save_contract_document(): ?string
    {
        if ($this->contract) {
            return $this->save_private_document->execute('Contracts', $this->contract);
        }

        return null;
    }

    public function save_brd_document(): ?string
    {
        if ($this->brd_document) {
            return $this->save_private_document->execute('BRDs', $this->brd_document);
        }

        return null;
    }

    public function to_array(): array
    {
        $data = [
            'id' => $this->project_version->id,
            'client_id' => $this->client_id,
            'version_number' => $this->version_number,
            'project_version_name' => $this->project_version_name,
            'project_progress_status' => $this->project_progress_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'quotation_id' => $this->quotation_id,
            'sprint_duration_days' => $this->sprint_duration_days,
            'hosting_and_domain_fee' => $this->hosting_and_domain_fee,
            'has_whatsapp_integration' => $this->has_whatsapp_integration,
            'has_ai_integration' => $this->has_ai_integration,
            'has_payments_integration' => $this->has_payments_integration,
            'has_other_third_party_integrations' => $this->has_other_third_party_integrations,
            'maintenance_type' => $this->maintenance_type,
            'maintenance_fee_monthly' => $this->maintenance_fee_monthly,
            'billing_type' => $this->billing_type,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'balance' => $this->balance,
            'currency' => $this->currency,
        ];

        $data['brd_document'] = $this->brd_document ? $this->save_brd_document() : ($this->project_version->brd_document ?? null);

        $data['contract'] = $this->contract ? $this->save_contract_document() : ($this->project_version->contract ?? null);
        
        $data['nda'] = $this->nda ? $this->save_nda_document() : ($this->project_version->nda ?? null);

        return $data;
    }

    public function update_project_version(): void
    {
        $this->validate();

        $project_version_dto = ProjectVersionDTO::from_array($this->to_array());

        $updated = $this->project_version_service->update($project_version_dto);

        if (!$updated) {
            session()->flash('error', 'Failed to update project version. Please try again.');
            return;
        }

        $this->dispatch('project-version-updated-successfully');
    }

    #[On('initiate_update_project_version')]
    public function handle_initiate_open_edit_project_version_modal(string $project_version_id): void
    {
        $this->clients = $this->client_repository->fetch_all();
        $project_version = $this->project_version_service->fetch_one($project_version_id);
        $this->project_version = $project_version;
        
        if ($project_version) {
            $this->client_id = $project_version->client_id;
            $this->version_number = $project_version->version_number;
            $this->project_version_name = $project_version->project_version_name;
            $this->project_progress_status = $project_version->project_progress_status;
            $this->start_date = $project_version->start_date;
            $this->end_date = $project_version->end_date;
            $this->quotation_id = $project_version->quotation_id;
            $this->sprint_duration_days = $project_version->sprint_duration_days;
            $this->hosting_and_domain_fee = $project_version->hosting_and_domain_fee;
            $this->has_whatsapp_integration = $project_version->has_whatsapp_integration;
            $this->has_ai_integration = $project_version->has_ai_integration;
            $this->has_payments_integration = $project_version->has_payments_integration;
            $this->has_other_third_party_integrations = $project_version->has_other_third_party_integrations;
            $this->maintenance_type = $project_version->maintenance_type;
            $this->maintenance_fee_monthly = $project_version->maintenance_fee_monthly;
            $this->billing_type = $project_version->billing_type;
            $this->amount = $project_version->amount;
            $this->paid = $project_version->paid;
            $this->balance = $project_version->balance;
            $this->currency = $project_version->currency;
        }

        $this->dispatch('view-update-project-version-modal');
    }

    public function render()
    {
        return view('livewire.update-project-version-livewire');
    }
}
