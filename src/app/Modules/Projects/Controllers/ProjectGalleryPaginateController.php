<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectGalleryService;
use App\Modules\Projects\Services\ProjectService;

class ProjectGalleryPaginateController extends Controller
{
    private $projectGalleryService;
    private $projectService;

    public function __construct(ProjectGalleryService $projectGalleryService, ProjectService $projectService)
    {
        $this->projectGalleryService = $projectGalleryService;
        $this->projectService = $projectService;
    }

    public function get(Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectGalleryService->paginate(10, $project_id);
        return view('admin.pages.projects.gallery.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
