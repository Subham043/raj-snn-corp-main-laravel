<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectSectionHeadingRequest;
use App\Modules\Projects\Services\ProjectService;
use Illuminate\Support\Facades\URL;

class ProjectSectionHeadingController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function post(ProjectSectionHeadingRequest $request, Int $project_id){
        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $this->projectService->updateHeading([$request->key => $request->heading], $project);
            return redirect()->intended(URL::previous())->with('success_status', 'Heading saved successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(URL::previous())->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
