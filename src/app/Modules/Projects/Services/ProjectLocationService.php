<?php

namespace App\Modules\Projects\Services;

use App\Modules\Projects\Models\ProjectLocation;
use App\Modules\Projects\Requests\ProjectLocationRequest;

class ProjectLocationService
{
    private $projectLocationModel;
    private $path = 'public/upload/projects_about';

    public function __construct(ProjectLocation $projectLocationModel)
    {
        $this->projectLocationModel = $projectLocationModel;
    }

    public function getById(Int $id): ProjectLocation
    {
        return $this->projectLocationModel->findOrFail($id);
    }

    public function getByProjectId(Int $project_id): ProjectLocation|null
    {
        return $this->projectLocationModel->where('project_id', $project_id)->first();
    }

    public function createOrUpdate(ProjectLocationRequest $request, Int $project_id) : void
    {
        $this->projectLocationModel->updateOrCreate(
            [
                ...$request->except('location_heading'),
            ],
            ['project_id' => $project_id]
        );
    }
}
