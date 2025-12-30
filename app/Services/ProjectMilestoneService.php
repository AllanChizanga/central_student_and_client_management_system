<?php

namespace App\Services;

use App\Repositories\ProjectMilestoneRepository;
use Illuminate\Support\Collection;

class ProjectMilestoneService
{
    /**
     * Create a new class instance.
     */
    protected ProjectMilestoneRepository $project_milestone_repository;

    public function __construct(ProjectMilestoneRepository $project_milestone_repository)
    {
        $this->project_milestone_repository = $project_milestone_repository;
    }

    public function create($project_milestone_dto)
    {
        return $this->project_milestone_repository->create($project_milestone_dto);
    }

    public function fetch_one(string $id)
    {
        return $this->project_milestone_repository->fetch_one($id);
    }

    public function fetch_all(): Collection
    {
        return $this->project_milestone_repository->fetch_all();
    }

    public function update($project_milestone_dto)
    {
        return $this->project_milestone_repository->update($project_milestone_dto);
    }

    public function delete(string $id): bool
    {
        return $this->project_milestone_repository->delete($id);
    }
}
