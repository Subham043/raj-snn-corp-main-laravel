<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectAmenitiesService;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectAmenitiesPaginateController extends Controller
{
    private $projectAmenitiesService;
    private $projectService;

    public function __construct(ProjectAmenitiesService $projectAmenitiesService, ProjectService $projectService)
    {
        $this->projectAmenitiesService = $projectAmenitiesService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectAmenitiesService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.amenities.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
