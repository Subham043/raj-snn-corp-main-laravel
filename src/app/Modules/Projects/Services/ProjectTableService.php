<?php

namespace App\Modules\Projects\Services;

use App\Modules\Projects\Models\ProjectTable;
use App\Modules\Projects\Requests\ProjectTableRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProjectTableService
{
    private $projectTableModel;

    public function __construct(ProjectTable $projectTableModel)
    {
        $this->projectTableModel = $projectTableModel;
    }

    public function getById(Int $id): ProjectTable
    {
        return $this->projectTableModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectTableModel->where('project_id', $project_id)->where('unit', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectTableModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectTableRequest $request, Int $project_id): void
    {
        $this->projectTableModel->create([
            ...$request->validated(),
            'project_id' => $project_id
        ]);
    }

    public function update(ProjectTableRequest $request, ProjectTable $data) : void
    {
        $data->update([
            ...$request->validated(),
        ]);
    }

    public function delete(ProjectTable $data): void
    {
        $data->delete();
    }

}
