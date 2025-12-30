<?php

namespace App\Repositories;

use App\DTOs\ProjectMilestoneDTO;
use App\Models\ProjectMilestone;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProjectMilestoneRepository
{
    public function create(ProjectMilestoneDTO $project_milestone_dto): ?ProjectMilestone
    {
        try {
            $data = $project_milestone_dto->to_array();
            unset($data['id']);
            return ProjectMilestone::create($data);
        } catch (Throwable $e) {
            Log::error('ProjectMilestone create error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $project_milestone_dto->to_array(),
            ]);
            return null;
        }
    }

    public function fetch_one(string $id): ?ProjectMilestone
    {
        try {
            return ProjectMilestone::find($id);
        } catch (Throwable $e) {
            Log::error("ProjectMilestone fetch_one error", [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    public function fetch_all(): Collection
    {
        try {
            return ProjectMilestone::all();
        } catch (Throwable $e) {
            Log::error("ProjectMilestone fetch_all error", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return collect();
        }
    }

    public function update(ProjectMilestoneDTO $project_milestone_dto): ?ProjectMilestone
    {
        if (!$project_milestone_dto->id) {
            return null;
        }

        try {
            $milestone = ProjectMilestone::find($project_milestone_dto->id);

            if ($milestone) {
                $data = $project_milestone_dto->to_array();
                unset($data['id']);
                $milestone->update($data);
            }

            return $milestone;
        } catch (Throwable $e) {
            Log::error('ProjectMilestone update error', [
                'id' => $project_milestone_dto->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $project_milestone_dto->to_array(),
            ]);
            return null;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $milestone = ProjectMilestone::find($id);
            if ($milestone) {
                return (bool) $milestone->delete();
            }
            return false;
        } catch (Throwable $e) {
            Log::error('ProjectMilestone delete error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }
}
