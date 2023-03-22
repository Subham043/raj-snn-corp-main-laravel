<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectAmenitiesCreateRequest;
use App\Modules\Projects\Services\ProjectSpecificationService;

class ProjectSpecificationCreateController extends Controller
{
    private $projectService;
    private $projectSpecificationService;

    public function __construct(ProjectSpecificationService $projectSpecificationService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectSpecificationService = $projectSpecificationService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.specification.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectAmenitiesCreateRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectSpecificationService->create($request, $project_id);
            return redirect()->intended(route('project_specification_create.get', $project_id))->with('success_status', 'Project Specification created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_specification_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
