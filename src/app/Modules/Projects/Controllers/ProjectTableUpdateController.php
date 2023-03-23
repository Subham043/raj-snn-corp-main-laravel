<?php

namespace App\Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Requests\ProjectTableRequest;
use App\Modules\Projects\Services\ProjectTableService;

class ProjectTableUpdateController extends Controller
{
    private $projectTableService;

    public function __construct(ProjectTableService $projectTableService)
    {
        $this->projectTableService = $projectTableService;
    }

    public function get(Int $project_id, Int $id){
        $data = $this->projectTableService->getById($id);
        return view('admin.pages.projects.table.update')->with(
            [
                'data' => $data,
                'project_id' => $project_id,
            ]
        );
    }

    public function post(ProjectTableRequest $request, Int $project_id,  Int $id){
        $data = $this->projectTableService->getById($id);
        try {
            //code...
            $this->projectTableService->update($request, $data);
            return redirect()->intended(route('project_table_update.get', [$project_id, $id]))->with('success_status', 'Project Table Data updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('project_table_update.get', [$project_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
