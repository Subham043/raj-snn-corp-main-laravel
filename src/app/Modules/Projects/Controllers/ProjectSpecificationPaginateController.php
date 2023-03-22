<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectSpecificationService;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectSpecificationPaginateController extends Controller
{
    private $projectSpecificationService;
    private $projectService;

    public function __construct(ProjectSpecificationService $projectSpecificationService, ProjectService $projectService)
    {
        $this->projectSpecificationService = $projectSpecificationService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectSpecificationService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.specification.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
