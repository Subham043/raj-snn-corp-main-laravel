<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectPaginateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get(Request $request){
        $data = $this->projectService->paginate($request, 10);
        return view('admin.pages.projects.paginate')->with(
            [
                'data' => $data
            ]
        );
    }
}
