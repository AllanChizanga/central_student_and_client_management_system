<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProjectVersion;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewProjectVersionLivewire extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    /**
     * Use the Bootstrap pagination theme.
     */
    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }  


    #initiate_open_add_project_version_modal 
    public function initiate_open_add_project_version_modal()
    {
        $this->dispatch('initiate_open_add_project_version_modal');
    }


    #initiate_update_project_version 
    public function initiate_update_project_version($project_version_id)
    { 

        $this->dispatch('initiate_update_project_version',$project_version_id);

    } 

    #open_milestone_creation 
    public function open_milestone_creation($project_version_id)
    { 
       

        $this->dispatch('initiate_open_milestone_creation',$project_version_id);

    }


    #delete 
    public function delete($project_version_id)
    { 
        $this->dispatch('not-authorized');

    } 


    #pay_for_project_version 
    public function pay_for_project_version($project_version_id)
    {
        $this->dispatch('initiate_pay_for_project_version',$project_version_id);
    }
 

    public function download_invoice($project_version_id)
    { 
        $this->project_version = ProjectVersion::findOrFail($project_version_id);
        $pdf = Pdf::loadView('pdfs.project_invoices', [
            'project_version' => $this->project_version,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'invoice.pdf');
    }  // endof



     #render
    public function render()
    {
        $project_versions = ProjectVersion::query()
            ->when($this->search, function ($query) {
                $search = $this->search;
                $query->where(function ($q) use ($search) {
                    $q->where('project_version_name', 'like', "%{$search}%")
                        ->orWhere('version_number', 'like', "%{$search}%")
                        ->orWhere('project_progress_status', 'like', "%{$search}%")
                        ->orWhere('maintenance_type', 'like', "%{$search}%")
                        ->orWhere('billing_type', 'like', "%{$search}%")
                        ->orWhere('currency', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        foreach ($project_versions as $project_version) {
            $milestoneCount = $project_version->milestones()->count();
            if ($milestoneCount < 2) {
            session()->flash('error', 'Add Milestones for '.$project_version->project_version_name);
                
               
            
            }
        }

        return view('livewire.view-project-version-livewire', [
            'project_versions' => $project_versions,
        ]);
    }
}
