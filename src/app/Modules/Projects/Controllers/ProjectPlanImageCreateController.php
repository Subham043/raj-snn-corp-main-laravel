<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectPlanCategoryService;
use App\Modules\Projects\Requests\ProjectPlanImageRequest;
use App\Modules\Projects\Services\ProjectPlanImageService;

class ProjectPlanImageCreateController extends Controller
{
    private $projectPlanCategoryService;
    private $projectGalleryService;

    public function __construct(ProjectPlanImageService $projectGalleryService, ProjectPlanCategoryService $projectPlanCategoryService)
    {
        $this->projectPlanCategoryService = $projectPlanCategoryService;
        $this->projectGalleryService = $projectGalleryService;
    }

    public function get(Int $project_id, Int $plan_category_id){
        $this->projectPlanCategoryService->getById($plan_category_id);
        return view('admin.pages.projects.plan_image.create')->with(
            [
                'project_id' => $project_id,
                'plan_category_id' => $plan_category_id,
            ]
        );
    }

    public function post(ProjectPlanImageRequest $request, Int $project_id, Int $plan_category_id){
        $this->projectPlanCategoryService->getById($plan_category_id);
        try {
            //code...
            $this->projectGalleryService->create($request, $plan_category_id);
            return redirect()->intended(route('project_plan_image_create.get', [$project_id, $plan_category_id]))->with('success_status', 'Project Plan Image created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_plan_image_create.get', [$project_id, $plan_category_id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
