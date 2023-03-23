<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectPlanCategoryRequest;
use App\Modules\Projects\Services\ProjectPlanCategoryService;

class ProjectPlanCategoryCreateController extends Controller
{
    private $projectService;
    private $projectPlanCategoryService;

    public function __construct(ProjectPlanCategoryService $projectPlanCategoryService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectPlanCategoryService = $projectPlanCategoryService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.plan_category.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectPlanCategoryRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectPlanCategoryService->create($request, $project_id);
            return redirect()->intended(route('project_plan_category_create.get', $project_id))->with('success_status', 'Project Plan Category created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_plan_category_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
