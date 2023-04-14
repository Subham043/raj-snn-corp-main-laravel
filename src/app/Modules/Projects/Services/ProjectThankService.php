<?php

namespace App\Modules\Projects\Services;

use App\Modules\Projects\Models\ProjectThank;
use App\Modules\Projects\Requests\ProjectThankRequest;

class ProjectThankService
{
    private $projectThankModel;

    public function __construct(ProjectThank $projectThankModel)
    {
        $this->projectThankModel = $projectThankModel;
    }

    public function getById(Int $id): ProjectThank
    {
        return $this->projectThankModel->findOrFail($id);
    }

    public function getByProjectId(Int $project_id): ProjectThank|null
    {
        return $this->projectThankModel->where('project_id', $project_id)->first();
    }

    public function createOrUpdate(ProjectThankRequest $request, Int $project_id) : void
    {
        $this->projectThankModel->updateOrCreate(
            ['project_id' => $project_id],
            [
                ...$request->validated(),
            ]
        );
    }
}
