<?php

namespace App\Modules\Projects\Services;

use App\Modules\Projects\Models\ProjectPlanCategory;
use App\Modules\Projects\Requests\ProjectPlanCategoryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProjectPlanCategoryService
{
    private $projectPlanCategoryModel;

    public function __construct(ProjectPlanCategory $projectPlanCategoryModel)
    {
        $this->projectPlanCategoryModel = $projectPlanCategoryModel;
    }

    public function getById(Int $id): ProjectPlanCategory
    {
        return $this->projectPlanCategoryModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectPlanCategoryModel->where('project_id', $project_id)->where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectPlanCategoryModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectPlanCategoryRequest $request, Int $project_id): void
    {
        $this->projectPlanCategoryModel->create([
            ...$request->validated(),
            'project_id' => $project_id
        ]);
    }

    public function update(ProjectPlanCategoryRequest $request, ProjectPlanCategory $data) : void
    {
        $data->update([
            ...$request->validated(),
        ]);
    }

    public function delete(ProjectPlanCategory $data): void
    {
        $data->delete();
    }

}
