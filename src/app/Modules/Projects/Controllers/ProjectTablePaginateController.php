<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectTableService;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectTablePaginateController extends Controller
{
    private $projectTableService;
    private $projectService;

    public function __construct(ProjectTableService $projectTableService, ProjectService $projectService)
    {
        $this->projectTableService = $projectTableService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectTableService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.table.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
