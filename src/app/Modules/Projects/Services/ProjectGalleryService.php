<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectGallery;
use App\Modules\Projects\Requests\ProjectGalleryCreateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectGalleryService
{
    private $projectSpecificationModel;
    private $path = 'public/upload/projects_gallery';

    public function __construct(ProjectGallery $projectSpecificationModel)
    {
        $this->projectSpecificationModel = $projectSpecificationModel;
    }

    public function getById(Int $id): ProjectGallery
    {
        return $this->projectSpecificationModel->findOrFail($id);
    }

    public function paginate(Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        return $this->projectSpecificationModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectGalleryCreateRequest $request, Int $project_id): void
    {
        $image = (new FileService)->save_file($request, 'image', $this->path);
        $this->projectSpecificationModel->create([
            'image' => $image,
            'project_id' => $project_id,
        ]);
    }

    public function delete(ProjectGallery $data): void
    {
        (new FileService)->delete_file('app/'.$this->path.'/'.$data->image);
        $data->delete();
    }

}
