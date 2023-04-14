<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectAbout;
use App\Modules\Projects\Requests\ProjectAboutRequest;

class ProjectAboutService
{
    private $projectAboutModel;
    private $path = 'public/upload/projects_about';

    public function __construct(ProjectAbout $projectAboutModel)
    {
        $this->projectAboutModel = $projectAboutModel;
    }

    public function getById(Int $id): ProjectAbout
    {
        return $this->projectAboutModel->findOrFail($id);
    }

    public function getByProjectId(Int $project_id): ProjectAbout|null
    {
        return $this->projectAboutModel->where('project_id', $project_id)->first();
    }

    public function createOrUpdate(ProjectAboutRequest $request, Int $project_id) : void
    {
        $file_array = [];
        if($request->hasFile('left_image')){
            $left_image = (new FileService)->save_file($request, 'left_image', $this->path);
            $file_array['left_image'] = $left_image;
        }
        if($request->hasFile('about_logo')){
            $about_logo = (new FileService)->save_file($request, 'about_logo', $this->path);
            $file_array['about_logo'] = $about_logo;
        }

        $this->projectAboutModel->updateOrCreate(
            ['project_id' => $project_id],
            [
                ...$request->except('left_image', 'about_logo'),
                ...$file_array
            ]
        );
    }
}
