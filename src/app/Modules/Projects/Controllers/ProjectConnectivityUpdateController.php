<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectConnectivityRequest;
use App\Modules\Projects\Services\ProjectConnectivityService;

class ProjectConnectivityUpdateController extends Controller
{
    private $projectConnectivityService;

    public function __construct(ProjectConnectivityService $projectConnectivityService)
    {
        $this->projectConnectivityService = $projectConnectivityService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectConnectivityService->getById($id);
        return view('admin.pages.projects.connectivity.update')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }

    public function post(ProjectConnectivityRequest $request, Int $project_id,  Int $id){
        $data = $this->projectConnectivityService->getById($id);
        try {
            //code...
            $this->projectConnectivityService->update($request, $data);
            return redirect()->intended(route('project_connectivity_update.get', [$project_id, $id]))->with('success_status', 'Project Connectivity updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_connectivity_update.get', [$project_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
