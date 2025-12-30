<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\ProjectVersion;
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

    #[On('view-milestones-modal')]
    public function handle_view_milestones_modal($project_version_id): void
    { 
        
        $this->project_version_id = $project_version_id;
        $this->resetPage();
        $this->project_version = ProjectVersion::query()->where('id', $project_version_id)->first();
      
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

        return view('livewire.view-project-milestone-livewire', [
            'milestones' => $milestones,
        ]);
    }
}
