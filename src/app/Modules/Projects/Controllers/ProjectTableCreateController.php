<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectTableRequest;
use App\Modules\Projects\Services\ProjectTableService;

class ProjectTableCreateController extends Controller
{
    private $projectService;
    private $projectTableService;

    public function __construct(ProjectTableService $projectTableService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectTableService = $projectTableService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.table.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectTableRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectTableService->create($request, $project_id);
            return redirect()->intended(route('project_table_create.get', $project_id))->with('success_status', 'Project Table Data created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_table_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
