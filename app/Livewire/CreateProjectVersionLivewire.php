<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\DTOs\ProjectVersionDTO;
use Livewire\Attributes\Validate;
use App\Repositories\ClientRepository;
use App\Services\ProjectVersionService;
use App\Actions\SavePrivateDocumentAction;
use Illuminate\Database\Eloquent\Collection;

class CreateProjectVersionLivewire extends Component
{    
     use WithFileUploads;
    #client_id and attributes from projectversion model 
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

    #[Validate(['required', 'file', 'max:10240'])]
    public $brd_document;

    #[Validate(['required', 'file', 'max:10240'])]
    public $contract;

    #[Validate(['required', 'file', 'max:10240'])]
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

    #attributes to fill the select tags 
  
    public Collection $clients;

    #boot 
    protected ClientRepository $client_repository;
    protected ProjectVersionService $project_version_service;
    protected SavePrivateDocumentAction $save_private_document;

    public function boot(ClientRepository $client_repository,ProjectVersionService $project_version_service,SavePrivateDocumentAction $save_private_document): void
    {
        $this->client_repository = $client_repository;
        $this->project_version_service = $project_version_service;
        $this->save_private_document = $save_private_document;
     
    }
  

    #save nda 
    public function save_nda_document()
    {
        $nda_document_path = $this->save_private_document->execute('NDAs',$this->nda); #NDAs is the directory storage/app/NDAs
        return $nda_document_path;
    }

    #save contract 
    public function save_contract_document()
    {
        $contract_document_path = $this->save_private_document->execute('Contracts',$this->contract); 
        return $contract_document_path;
    }

    #save brd 
    public function save_brd_document()
    {
        $brd_document_path = $this->save_private_document->execute('BRDs',$this->brd_document); 
        return $brd_document_path;
    }

    #to array for project version 
    public function to_array(): array
    {
        return [
            'client_id' => $this->client_id,
            'version_number' => $this->version_number,
            'project_version_name' => $this->project_version_name,
            'project_progress_status' => $this->project_progress_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'brd_document' => $this->save_brd_document(),
            'contract' => $this->save_contract_document(),
            'nda' => $this->save_nda_document(),
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
    }

    #create project version using dto service and repository 
    public function create_project_version()
    {
        $this->validate();
        #dto  from_array 
        $project_version_dto = ProjectVersionDTO::from_array($this->to_array());
        #service 
        $project_version =  $this->project_version_service->create($project_version_dto);
        #feedback
        if(!$project_version)
        {
        session()->flash('error', 'Failed to create project version. Please try again.');
        return;
        }
        else{
        $this->dispatch('project-version-created-successfully');
        }
    }

    #
 


    #events 
    #[On('initiate_open_add_project_version_modal')]
    public function handle_initiate_open_add_project_version_modal(): void
    { 
        $this->clients = $this->client_repository->fetch_all();
        $this->dispatch('view-create-project-version-modal');
    }

    #render 
    public function render()
    {
        return view('livewire.create-project-version-livewire');
    }
}
