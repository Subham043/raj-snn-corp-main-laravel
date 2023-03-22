<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use App\Modules\Projects\Requests\ProjectAmenitiesCreateRequest;
use App\Modules\Projects\Services\ProjectAmenitiesService;

class ProjectAmenitiesCreateController extends Controller
{
    private $projectService;
    private $projectAmenitiesService;

    public function __construct(ProjectAmenitiesService $projectAmenitiesService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->projectAmenitiesService = $projectAmenitiesService;
    }

    public function get(Int $project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.projects.amenities.create')->with(
            [
                'project_id' => $project_id
            ]
        );
    }

    public function post(ProjectAmenitiesCreateRequest $request, Int $project_id){
        $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectAmenitiesService->create($request, $project_id);
            return redirect()->intended(route('project_amenities_create.get', $project_id))->with('success_status', 'Project Amenity created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_amenities_create.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
