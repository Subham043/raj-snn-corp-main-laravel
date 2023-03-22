<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectAmenitiesUpdateRequest;
use App\Modules\Projects\Services\ProjectSpecificationService;

class ProjectSpecificationUpdateController extends Controller
{
    private $projectSpecificationService;

    public function __construct(ProjectSpecificationService $projectSpecificationService)
    {
        $this->projectSpecificationService = $projectSpecificationService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectSpecificationService->getById($id);
        return view('admin.pages.projects.specification.update')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }

    public function post(ProjectAmenitiesUpdateRequest $request, Int $project_id,  Int $id){
        $data = $this->projectSpecificationService->getById($id);
        try {
            //code...
            $this->projectSpecificationService->update_image($request, $data);
            $this->projectSpecificationService->update($request, $data);
            return redirect()->intended(route('project_specification_update.get', [$project_id, $id]))->with('success_status', 'Project Specification updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_specification_update.get', [$project_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
