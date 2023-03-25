<?php

namespace App\Modules\Projects\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;

class ProjectViewMainController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get($slug){
        $data = $this->projectService->getBySlug($slug);
        return view('project.pages.index')->with('data', $data);
    }
    // public function get(Int $id){
    //     $data = $this->projectService->getById($id);
    //     try {
    //         //code...
    //         $this->projectService->delete($data);
    //         return redirect()->intended(route('project_list.get'))->with('success_status', 'Project deleted successfully.');
    //     } catch (\Throwable $th) {
    //         throw $th;
    //         return redirect(route('project_list.get'))->with('error_status', 'Oops! Something went wrong. Please try again!');
    //     }
    // }
}
