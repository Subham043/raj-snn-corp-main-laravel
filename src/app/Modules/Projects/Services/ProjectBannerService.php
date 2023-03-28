<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectBanner;
use App\Modules\Projects\Requests\ProjectBannerRequest;

class ProjectBannerService
{
    private $projectBannerModel;
    private $path = 'upload/projects_banner';

    public function __construct(ProjectBanner $projectBannerModel)
    {
        $this->projectBannerModel = $projectBannerModel;
    }

    public function getById(Int $id): ProjectBanner
    {
        return $this->projectBannerModel->findOrFail($id);
    }

    public function getByProjectId(Int $project_id): ProjectBanner|null
    {
        return $this->projectBannerModel->where('project_id', $project_id)->first();
    }

    public function createOrUpdate(ProjectBannerRequest $request, Int $project_id) : void
    {
        $banner_image = (new FileService)->save_file($request, 'banner_image', $this->path);

        $this->projectBannerModel->updateOrCreate(
            [
                ...$request->except('banner_image'),
                'banner_image' => $banner_image,
            ],
            ['project_id' => $project_id]
        );
    }
}
