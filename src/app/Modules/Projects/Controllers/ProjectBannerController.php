<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectBannerRequest;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Services\ProjectBannerService;

class ProjectBannerController extends Controller
{
    private $projectService;
    private $projectBannerService;

    public function __construct(ProjectBannerService $projectBannerService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectBannerService = $projectBannerService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        $data = $this->projectBannerService->getByProjectId($project_id);
        return view('admin.pages.projects.banner')->with(
            [
                'data' => $data,
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectBannerRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectBannerService->createOrUpdate($request, $project_id);
            return redirect()->intended(route('project_banner.get', $project_id))->with('success_status', 'Project Banner Details saved successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_banner.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
