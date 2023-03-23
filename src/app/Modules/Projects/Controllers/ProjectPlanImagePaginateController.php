<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectPlanImageService;
use App\Modules\Projects\Services\ProjectPlanCategoryService;

class ProjectPlanImagePaginateController extends Controller
{
    private $projectPlanImageService;
    private $projectPlanCategoryService;

    public function __construct(ProjectPlanImageService $projectPlanImageService, ProjectPlanCategoryService $projectPlanCategoryService)
    {
        $this->projectPlanImageService = $projectPlanImageService;
        $this->projectPlanCategoryService = $projectPlanCategoryService;
    }

    public function get(Int $project_id, Int $plan_category_id){
        $project = $this->projectPlanCategoryService->getById($plan_category_id);
        $data = $this->projectPlanImageService->paginate(10, $plan_category_id);
        return view('admin.pages.projects.plan_image.paginate')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id,
                'plan_category_id' => $plan_category_id,
            ]
        );
    }
}
