<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectGalleryCreateRequest;
use App\Modules\Projects\Services\ProjectGalleryService;

class ProjectGalleryCreateController extends Controller
{
    private $projectService;
    private $projectGalleryService;

    public function __construct(ProjectGalleryService $projectGalleryService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectGalleryService = $projectGalleryService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.gallery.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectGalleryCreateRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectGalleryService->create($request, $project_id);
            return redirect()->intended(route('project_gallery_create.get', $project_id))->with('success_status', 'Project Gallery Image created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_gallery_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
