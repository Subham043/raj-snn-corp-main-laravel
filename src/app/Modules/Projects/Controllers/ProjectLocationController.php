<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectLocationRequest;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Services\ProjectLocationService;

class ProjectLocationController extends Controller
{
    private $projectService;
    private $projectLocationService;

    public function __construct(ProjectLocationService $projectLocationService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectLocationService = $projectLocationService;
    }

    public function get(Int $project_id){
        $project = $this->projectService->getById($project_id);
        $data = $this->projectLocationService->getByProjectId($project_id);
        return view('admin.pages.projects.location')->with(
            [
                'data' => $data,
                'project' => $project,
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectLocationRequest $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectLocationService->createOrUpdate($request, $project_id);
            $this->projectService->updateHeading($request->only('location_heading'), $project);
            return redirect()->intended(route('project_location.get', $project_id))->with('success_status', 'Project created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_location.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
