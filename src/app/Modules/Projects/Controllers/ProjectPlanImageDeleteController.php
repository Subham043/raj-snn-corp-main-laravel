<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectPlanImageService;

class ProjectPlanImageDeleteController extends Controller
{
    private $projectPlanImageService;

    public function __construct(ProjectPlanImageService $projectPlanImageService)
    {
        $this->projectPlanImageService = $projectPlanImageService;
    }

    public function get(Int $project_id, Int $plan_category_id, Int $id){
        $data = $this->projectPlanImageService->getById($id);
        try {
            //code...
            $this->projectPlanImageService->delete($data);
            return redirect()->intended(route('project_plan_image_list.get', [$project_id, $plan_category_id]))->with('success_status', 'Project Plan Image deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_plan_image_list.get', [$project_id, $plan_category_id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
