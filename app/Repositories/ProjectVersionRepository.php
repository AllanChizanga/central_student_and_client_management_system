<?php

namespace App\Repositories;

use App\Models\ProjectVersion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProjectVersionRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create($project_version_dto)
    {
        try {
            $data = $project_version_dto->to_array();
            unset($data['id']);

            return ProjectVersion::create($data);

        } 
        catch (Throwable $e) 
        {
            Log::error('Failed to create ProjectVersion', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $project_version_dto?->to_array(),
            ]);
            throw $e;
          return null;
        }
    }

    public function fetch_one(string $id)
    {
        try {
            return ProjectVersion::findOrFail($id);
        } catch (Throwable $e) {
            Log::error('Failed to fetch ProjectVersion', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function fetch_all(): Collection
    {
        try {
            return ProjectVersion::all();
        } catch (Throwable $e) {
            Log::error('Failed to fetch all ProjectVersions', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function update($project_version_dto)
    {
        try {
            $data = $project_version_dto->to_array();
            $projectVersion = ProjectVersion::findOrFail($project_version_dto->id);
            $projectVersion->update($data);
            return $projectVersion;
        } catch (Throwable $e) {
            Log::error('Failed to update ProjectVersion', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'id' => $project_version_dto->id ?? null,
                'data' => $project_version_dto?->to_array(),
            ]);
            throw $e;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $projectVersion = ProjectVersion::findOrFail($id);
            return (bool) $projectVersion->delete();
        } catch (Throwable $e) {
            Log::error('Failed to delete ProjectVersion', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'id' => $id,
            ]);
            throw $e;
        }
    }
}
