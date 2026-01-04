<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\ProjectVersion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProjectMilestone;

class ViewProjectMilestoneLivewire extends Component
{
    use WithPagination;

    public $search = '';
    public $project_version_id;

    protected $updatesQueryString = ['search', 'page'];

    protected $paginationTheme = 'bootstrap';

    #models 
    public  $project_version; 
    public  $milestones_private;

    public function download_quotation()
    { 
        $this->milestones_private = $this->project_version->milestones()->orderBy('due_date', 'asc')->get();
        
        $pdf = Pdf::loadView('pdfs.project_quotations', [
            'milestones' => $this->milestones_private,
            'project_version' => $this->project_version,
        ]);  

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'quotation.pdf');
      
    }//endof 

    #[On('view-milestones-modal')]
    public function handle_view_milestones_modal($project_version_id): void
    { 
        
        $this->project_version_id = $project_version_id;
        $this->resetPage();
        $this->project_version = ProjectVersion::with('client')->where('id', $project_version_id)->first();
      
        $this->dispatch('open-view-milestone-modal');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ProjectMilestone::query();

        if ($this->project_version_id) {
            $query->where('project_version_id', $this->project_version_id);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('deliverables', 'like', '%' . $this->search . '%');
            });
        }

        $milestones = $query->orderByDesc('due_date')->paginate(10);

        // $this->milestones_private = $milestones;

        return view('livewire.view-project-milestone-livewire', [
            'milestones' => $milestones,
        ]);
    }
}
