<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectConnectivityService;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectConnectivityPaginateController extends Controller
{
    private $projectConnectivityService;
    private $projectService;

    public function __construct(ProjectConnectivityService $projectConnectivityService, ProjectService $projectService)
    {
        $this->projectConnectivityService = $projectConnectivityService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectConnectivityService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.connectivity.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
