<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectPlanCategoryRequest;
use App\Modules\Projects\Services\ProjectPlanCategoryService;

class ProjectPlanCategoryUpdateController extends Controller
{
    private $projectPlanCategoryService;

    public function __construct(ProjectPlanCategoryService $projectPlanCategoryService)
    {
        $this->projectPlanCategoryService = $projectPlanCategoryService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectPlanCategoryService->getById($id);
        return view('admin.pages.projects.plan_category.update')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }

    public function post(ProjectPlanCategoryRequest $request, Int $project_id,  Int $id){
        $data = $this->projectPlanCategoryService->getById($id);
        try {
            //code...
            $this->projectPlanCategoryService->update($request, $data);
            return redirect()->intended(route('project_plan_category_update.get', [$project_id, $id]))->with('success_status', 'Project Plan Category updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_plan_category_update.get', [$project_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
