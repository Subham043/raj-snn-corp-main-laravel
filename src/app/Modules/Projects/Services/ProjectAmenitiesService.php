<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectAmenities;
use App\Modules\Projects\Requests\ProjectAmenitiesCreateRequest;
use App\Modules\Projects\Requests\ProjectAmenitiesUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProjectAmenitiesService
{
    private $projectAmenitiesModel;
    private $path = 'public/upload/projects_amenities';

    public function __construct(ProjectAmenities $projectAmenitiesModel)
    {
        $this->projectAmenitiesModel = $projectAmenitiesModel;
    }

    public function getById(Int $id): ProjectAmenities
    {
        return $this->projectAmenitiesModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectAmenitiesModel->where('project_id', $project_id)->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectAmenitiesModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectAmenitiesCreateRequest $request, Int $project_id): void
    {
        $icon_image = (new FileService)->save_file($request, 'icon_image', $this->path);
        $this->projectAmenitiesModel->create([
            ...$request->except('icon_image'),
            'icon_image' => $icon_image,
            'project_id' => $project_id,
        ]);
    }

    public function update(ProjectAmenitiesUpdateRequest $request, ProjectAmenities $data) : void
    {
        $data->update([
            ...$request->except('icon_image'),
        ]);
    }

    public function update_image(ProjectAmenitiesUpdateRequest $request, ProjectAmenities $data) : void
    {
        if($request->hasFile('icon_image')){
            $icon_image = (new FileService)->save_file($request, 'icon_image', $this->path);
            if($data->icon_image){
                (new FileService)->delete_file('app/'.$this->path.'/'.$data->icon_image);
            }
            $data->update([
                'icon_image' => $icon_image,
            ]);
        }
    }

    public function delete(ProjectAmenities $data): void
    {
        if($data->icon_image){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->icon_image);
        }
        $data->delete();
    }

}
