<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectConnectivityRequest;
use App\Modules\Projects\Services\ProjectConnectivityService;

class ProjectConnectivityCreateController extends Controller
{
    private $projectService;
    private $projectConnectivityService;

    public function __construct(ProjectConnectivityService $projectConnectivityService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectConnectivityService = $projectConnectivityService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.connectivity.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectConnectivityRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectConnectivityService->create($request, $project_id);
            return redirect()->intended(route('project_connectivity_create.get', $project_id))->with('success_status', 'Project Connectivity created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_connectivity_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
