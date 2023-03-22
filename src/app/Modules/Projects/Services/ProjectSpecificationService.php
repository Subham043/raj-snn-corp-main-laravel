<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectSpecification;
use App\Modules\Projects\Requests\ProjectAmenitiesCreateRequest;
use App\Modules\Projects\Requests\ProjectAmenitiesUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProjectSpecificationService
{
    private $projectSpecificationModel;
    private $path = 'public/upload/projects_specification';

    public function __construct(ProjectSpecification $projectSpecificationModel)
    {
        $this->projectSpecificationModel = $projectSpecificationModel;
    }

    public function getById(Int $id): ProjectSpecification
    {
        return $this->projectSpecificationModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectSpecificationModel->where('project_id', $project_id)->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectSpecificationModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectAmenitiesCreateRequest $request, Int $project_id): void
    {
        $icon_image = (new FileService)->save_file($request, 'icon_image', $this->path);
        $this->projectSpecificationModel->create([
            ...$request->except('icon_image'),
            'icon_image' => $icon_image,
            'project_id' => $project_id,
        ]);
    }

    public function update(ProjectAmenitiesUpdateRequest $request, ProjectSpecification $data) : void
    {
        $data->update([
            ...$request->except('icon_image'),
        ]);
    }

    public function update_image(ProjectAmenitiesUpdateRequest $request, ProjectSpecification $data) : void
    {
        if($request->hasFile('icon_image')){
            $icon_image = (new FileService)->save_file($request, 'icon_image', $this->path);
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->icon_image);
            $data->update([
                'icon_image' => $icon_image,
            ]);
        }
    }

    public function delete(ProjectSpecification $data): void
    {
        (new FileService)->delete_file('app/'.$this->path.'/'.$data->icon_image);
        $data->delete();
    }

}