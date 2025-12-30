<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProjectVersion;

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


    #delete 
    public function delete($project_version_id)
    { 
        $this->dispatch('not-authorized');

    }



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

        return view('livewire.view-project-version-livewire', [
            'project_versions' => $project_versions,
        ]);
    }
}
