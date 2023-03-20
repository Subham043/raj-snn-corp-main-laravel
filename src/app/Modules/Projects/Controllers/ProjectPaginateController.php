<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Modules\Projects\Services\ProjectService;

class ProjectPaginateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get(SearchRequest $request){
        dd($request->query());
        $data = $this->projectService->paginate(10);
        return view('admin.pages.projects.paginate')->with(
            [
                'data' => $data
            ]
        );
    }
}
