<?php

namespace App\Services;

use App\Models\ProjectVersion;
use Illuminate\Support\Collection;
use App\Repositories\ProjectVersionRepository;

class ProjectVersionService
{
    /**
     * Create a new class instance.
     */
    protected ProjectVersionRepository $project_version_repository;

    public function __construct(ProjectVersionRepository $project_version_repository)
    {
        $this->project_version_repository = $project_version_repository;
    }

    public function create($project_version_dto)
    {
        return $this->project_version_repository->create($project_version_dto);
    }

  
    public function fetch_one(string $id)
    {
        return $this->project_version_repository->fetch_one($id);
    }
    public function fetch_all(): Collection
    {
        return $this->project_version_repository->fetch_all();
    }

  
    public function update($project_version_dto)
    {
        return $this->project_version_repository->update($project_version_dto);
    }

  
    public function delete(string $id): bool
    {
        return $this->project_version_repository->delete($id);
    } 

    #>update_payment($amount) 
    public function update_payment($project_version,$amount)
    { 
        
        return $this->project_version_repository->update_payment($project_version,$amount);

    }


}
