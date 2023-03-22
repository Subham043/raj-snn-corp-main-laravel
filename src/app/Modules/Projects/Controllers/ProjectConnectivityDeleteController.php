<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectConnectivityService;

class ProjectConnectivityDeleteController extends Controller
{
    private $projectConnectivityService;

    public function __construct(ProjectConnectivityService $projectConnectivityService)
    {
        $this->projectConnectivityService = $projectConnectivityService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectConnectivityService->getById($id);
        try {
            //code...
            $this->projectConnectivityService->delete($data);
            return redirect()->intended(route('project_connectivity_list.get', $project_id))->with('success_status', 'Project Connectivity deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_connectivity_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
