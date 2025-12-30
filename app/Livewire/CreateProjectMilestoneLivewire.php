<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProjectVersion;
use App\DTOs\ProjectMilestoneDTO;
use Livewire\Attributes\Validate;
use App\Services\ProjectMilestoneService;

class CreateProjectMilestoneLivewire extends Component
{ 

    #[Validate('required|exists:project_versions,id')]
    public string $project_version_id;

    #[Validate('required|string|max:255')]
    public string $title;

    #[Validate('required|string')]
    public string $deliverables;

    #[Validate('required|integer|min:0')]
    public int $duration_days;

    #[Validate('required|numeric|min:0')]
    public float $amount;

    #[Validate('required|string|in:pending,paid,overdue')]
    public string $payment_status = 'pending';

    #[Validate('required|date')]
    public string $due_date;

    #[Validate('required|string')]
    public string $developers_notes; 

    #models 

    public ProjectVersion $project_version;

    #boot 
    protected ProjectMilestoneService $project_milestone_service;

    public function boot(ProjectMilestoneService $project_milestone_service): void
    {
        $this->project_milestone_service = $project_milestone_service;
    }

    #to array 
    public function to_array(): array
    {
        return [
            'project_version_id' => $this->project_version_id,
            'title' => $this->title,
            'deliverables' => $this->deliverables,
            'duration_days' => $this->duration_days,
            'amount' => $this->amount,
            'payment_status' => $this->payment_status,
            'due_date' => $this->due_date,
            'developers_notes' => $this->developers_notes,
        ];
    }

    #createcreate_project_milestone
    public function create_project_milestone()

    {
        #validate 
        $this->validate();
        #dto 
        $project_milestone_dto  = ProjectMilestoneDTO::from_array($this->to_array());
        #service 
        $created_milestone = $this->project_milestone_service->create($project_milestone_dto);
        #feedback
        if (!$created_milestone) {
            session()->flash('error', 'Failed to create project milestone. Please try again.');
        } else { 

        $this->dispatch('project-milestone-created-successfully', [
            'milestone' => $created_milestone,
        ]);
        session()->flash('success', 'Project milestone created successfully.');
           
        }
    }
      



    #[On('initiate_open_milestone_creation')]
    public function handle_initiate_open_milestone_creation($project_version_id): void
    {  
        $this->project_version_id = $project_version_id;
        $this->project_version = ProjectVersion::find($project_version_id);
        $this->dispatch('view-create-project-milestone-modal');
         
    } 


    #initiate_view_milestone 
    public function initiate_view_milestone($project_version_id): void
    {
        $this->project_version_id = $project_version_id;

        $this->dispatch('view-milestones-modal', [
            'project_version_id' => $project_version_id,
        ]);
    }
 

    #render
    public function render()
    { 
        $durationDays = isset($this->duration_days) ? (int) $this->duration_days : 0;
        $this->amount = 50 * $durationDays;
        return view('livewire.create-project-milestone-livewire');
    }
}
