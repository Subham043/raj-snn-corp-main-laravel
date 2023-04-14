<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectBanner;
use App\Modules\Projects\Requests\ProjectBannerRequest;

class ProjectBannerService
{
    private $projectBannerModel;
    private $path = 'public/upload/projects_banner';

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
        $file_array = [];
        if($request->hasFile('banner_image')){
            $banner_image = (new FileService)->save_file($request, 'banner_image', $this->path);
            $file_array['banner_image'] = $banner_image;
        }

        $this->projectBannerModel->updateOrCreate(
            ['project_id' => $project_id],
            [
                ...$request->except('banner_image'),
                ...$file_array
            ]
        );
    }
}
