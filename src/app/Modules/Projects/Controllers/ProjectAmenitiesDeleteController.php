<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectAmenitiesService;

class ProjectAmenitiesDeleteController extends Controller
{
    private $projectAmenitiesService;

    public function __construct(ProjectAmenitiesService $projectAmenitiesService)
    {
        $this->projectAmenitiesService = $projectAmenitiesService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectAmenitiesService->getById($id);
        try {
            //code...
            $this->projectAmenitiesService->delete($data);
            return redirect()->intended(route('project_amenities_list.get', $project_id))->with('success_status', 'Project Amenity deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_amenities_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
