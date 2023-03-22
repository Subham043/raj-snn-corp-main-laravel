<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectUpdateRequest;
use App\Modules\Projects\Services\ProjectService;

class ProjectUpdateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get(Int $id){
        $data = $this->projectService->getById($id);
        return view('admin.pages.projects.update')->with(
            [
                'data' => $data
            ]
        );
    }

    public function post(ProjectUpdateRequest $request, Int $id){
        $data = $this->projectService->getById($id);
        try {
            //code...
            $this->projectService->update_image($request, $data);
            $this->projectService->update($request, $data);
            return redirect()->intended(route('project_update.get', $id))->with('success_status', 'Project updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_update.get', $id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
