<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectCreateRequest;
use App\Modules\Projects\Services\ProjectService;

class ProjectCreateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get(){
        return view('admin.pages.projects.create');
    }

    public function post(ProjectCreateRequest $request){

        try {
            //code...
            $this->projectService->create($request);
            return redirect()->intended(route('project_create.get'))->with('success_status', 'Project created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_create.get'))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
