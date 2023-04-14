<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectThankRequest;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Services\ProjectThankService;

class ProjectThankController extends Controller
{
    private $projectService;
    private $projectThankService;

    public function __construct(ProjectThankService $projectThankService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectThankService = $projectThankService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        $data = $this->projectThankService->getByProjectId($project_id);
        return view('admin.pages.projects.thank')->with(
            [
                'data' => $data,
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectThankRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectThankService->createOrUpdate($request, $project_id);
            return redirect()->intended(route('project_thank.get', $project_id))->with('success_status', 'Project Thank You Details saved successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('project_thank.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
