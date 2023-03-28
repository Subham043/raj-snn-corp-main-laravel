<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectGallery;
use App\Modules\Projects\Requests\ProjectGalleryCreateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectGalleryService
{
    private $projectGalleryModel;
    private $path = 'upload/projects_gallery';

    public function __construct(ProjectGallery $projectGalleryModel)
    {
        $this->projectGalleryModel = $projectGalleryModel;
    }

    public function getById(Int $id): ProjectGallery
    {
        return $this->projectGalleryModel->findOrFail($id);
    }

    public function paginate(Int $limit = 10, Int $project_id): LengthAwarePaginator
    {
        return $this->projectGalleryModel->where('project_id', $project_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectGalleryCreateRequest $request, Int $project_id): void
    {
        $image = (new FileService)->save_file($request, 'image', $this->path);
        $this->projectGalleryModel->create([
            'image' => $image,
            'project_id' => $project_id,
        ]);
    }

    public function delete(ProjectGallery $data): void
    {
        if($data->image){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->image);
        }
        $data->delete();
    }

}
