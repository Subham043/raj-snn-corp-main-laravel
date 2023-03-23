<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectTableService;

class ProjectTableDeleteController extends Controller
{
    private $projectTableService;

    public function __construct(ProjectTableService $projectTableService)
    {
        $this->projectTableService = $projectTableService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectTableService->getById($id);
        try {
            //code...
            $this->projectTableService->delete($data);
            return redirect()->intended(route('project_table_list.get', $project_id))->with('success_status', 'Project Table Data deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_table_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
