<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectPlanCategoryService;

class ProjectPlanCategoryDeleteController extends Controller
{
    private $projectPlanCategoryService;

    public function __construct(ProjectPlanCategoryService $projectPlanCategoryService)
    {
        $this->projectPlanCategoryService = $projectPlanCategoryService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectPlanCategoryService->getById($id);
        try {
            //code...
            $this->projectPlanCategoryService->delete($data);
            return redirect()->intended(route('project_plan_category_list.get', $project_id))->with('success_status', 'Project Plan Category deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_plan_category_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
