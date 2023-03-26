<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;

class ProjectPreviewController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get($id){
        $data = $this->projectService->getPreview($id);
        return view('project.pages.index')->with('data', $data);
    }
}
