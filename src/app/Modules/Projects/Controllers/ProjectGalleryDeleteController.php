<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectGalleryService;

class ProjectGalleryDeleteController extends Controller
{
    private $projectGalleryService;

    public function __construct(ProjectGalleryService $projectGalleryService)
    {
        $this->projectGalleryService = $projectGalleryService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectGalleryService->getById($id);
        try {
            //code...
            $this->projectGalleryService->delete($data);
            return redirect()->intended(route('project_gallery_list.get', $project_id))->with('success_status', 'Project Gallery Image deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_gallery_list.get', $project_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
