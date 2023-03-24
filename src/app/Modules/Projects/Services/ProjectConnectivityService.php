<?php

namespace App\Modules\Projects\Services;

use App\Modules\Projects\Models\ProjectConnectivity;
use App\Modules\Projects\Requests\ProjectConnectivityRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProjectConnectivityService
{
    private $projectConnectivityModel;

    public function __construct(ProjectConnectivity $projectConnectivityModel)
    {
        $this->projectConnectivityModel = $projectConnectivityModel;
    }

    public function getById(Int $id): ProjectConnectivity
    {
        return $this->projectConnectivityModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectConnectivityModel->where('project_id', $project_id)->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectConnectivityModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectConnectivityRequest $request, Int $project_id): void
    {
        $this->projectConnectivityModel->create([
            ...$request->all(),
            'project_id' => $project_id,
        ]);
    }

    public function update(ProjectConnectivityRequest $request, ProjectConnectivity $data) : void
    {
        $data->update([
            ...$request->all(),
        ]);
    }

    public function delete(ProjectConnectivity $data): void
    {
        $data->delete();
    }

}
