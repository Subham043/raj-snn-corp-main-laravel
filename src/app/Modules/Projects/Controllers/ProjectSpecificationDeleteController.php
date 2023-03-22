<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectSpecificationService;

class ProjectSpecificationDeleteController extends Controller
{
    private $projectSpecificationService;

    public function __construct(ProjectSpecificationService $projectSpecificationService)
    {
        $this->projectSpecificationService = $projectSpecificationService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectSpecificationService->getById($id);
        try {
            //code...
            $this->projectSpecificationService->delete($data);
            return redirect()->intended(route('project_specification_list.get', $project_id))->with('success_status', 'Project Specification deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_specification_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
