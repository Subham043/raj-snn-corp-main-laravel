<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectAmenitiesService;
use Illuminate\Http\Request;

class ProjectAmenitiesPaginateController extends Controller
{
    private $projectAmenitiesService;

    public function __construct(ProjectAmenitiesService $projectAmenitiesService)
    {
        $this->projectAmenitiesService = $projectAmenitiesService;
    }

    public function get(Request $request, Int $project_id){
        $data = $this->projectAmenitiesService->paginate($request, 10, $project_id);
        return view('admin.pages.projects.amenities.paginate')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }
}
