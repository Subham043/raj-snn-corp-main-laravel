<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectAboutRequest;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Services\ProjectAboutService;

class ProjectAboutController extends Controller
{
    private $projectService;
    private $projectAboutService;

    public function __construct(ProjectAboutService $projectAboutService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectAboutService = $projectAboutService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        $data = $this->projectAboutService->getByProjectId($project_id);
        return view('admin.pages.projects.about')->with(
            [
                'data' => $data,
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectAboutRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectAboutService->createOrUpdate($request, $project_id);
            return redirect()->intended(route('project_about.get', $project_id))->with('success_status', 'Project About Details saved successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('project_about.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
