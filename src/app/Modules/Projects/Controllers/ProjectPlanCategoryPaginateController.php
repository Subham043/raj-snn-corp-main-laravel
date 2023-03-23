<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectPlanCategoryService;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectPlanCategoryPaginateController extends Controller
{
    private $projectPlanCategoryService;
    private $projectService;

    public function __construct(ProjectPlanCategoryService $projectPlanCategoryService, ProjectService $projectService)
    {
        $this->projectPlanCategoryService = $projectPlanCategoryService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectPlanCategoryService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.plan_category.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
            ]
        );
    }
}
