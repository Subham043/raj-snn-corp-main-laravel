<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectLocation;
use App\Modules\Projects\Requests\ProjectLocationRequest;

class ProjectLocationService
{
    private $projectLocationModel;
    private $path = 'upload/projects_location';

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
        $map_image = (new FileService)->save_file($request, 'map_image', $this->path);
        $this->projectLocationModel->updateOrCreate(
            [
                ...$request->except('location_heading', 'map_image'),
                'map_image' => $map_image,
            ],
            ['project_id' => $project_id]
        );
    }
}
