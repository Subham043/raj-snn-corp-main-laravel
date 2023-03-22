<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectAmenitiesUpdateRequest;
use App\Modules\Projects\Services\ProjectAmenitiesService;

class ProjectAmenitiesUpdateController extends Controller
{
    private $projectAmenitiesService;

    public function __construct(ProjectAmenitiesService $projectAmenitiesService)
    {
        $this->projectAmenitiesService = $projectAmenitiesService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectAmenitiesService->getById($id);
        return view('admin.pages.projects.amenities.update')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }

    public function post(ProjectAmenitiesUpdateRequest $request, Int $project_id,  Int $id){
        $data = $this->projectAmenitiesService->getById($id);
        try {
            //code...
            $this->projectAmenitiesService->update_image($request, $data);
            $this->projectAmenitiesService->update($request, $data);
            return redirect()->intended(route('project_amenities_update.get', [$project_id, $id]))->with('success_status', 'Project Amenity updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_amenities_update.get', [$project_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
