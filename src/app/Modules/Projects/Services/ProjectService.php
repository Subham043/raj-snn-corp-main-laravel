<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\Project;
use App\Modules\Projects\Requests\ProjectCreateRequest;
use App\Modules\Projects\Requests\ProjectUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectService
{
    private $projectModel;
    private $path = 'public/upload/projects';

    public function __construct(Project $projectModel)
    {
        $this->projectModel = $projectModel;
    }

    public function all(): Collection
    {
        return $this->projectModel->all();
    }

    public function paginate(Int $limit = 10): LengthAwarePaginator
    {
        return $this->projectModel->paginate($limit);
    }

    public function getById(Int $id): Project
    {
        return $this->projectModel->findOrFail($id);
    }

    public function getBySlug(String $slug): Project
    {
        return $this->projectModel->where('slug', $slug)->firstOrFail();
    }

    public function create(ProjectCreateRequest $request): void
    {
        $header_logo = (new FileService)->save_file($request, 'header_logo', $this->path);
        $footer_logo = (new FileService)->save_file($request, 'footer_logo', $this->path);
        $og_image = (new FileService)->save_file($request, 'og_image', $this->path);
        $this->projectModel->create([
            ...$request->except('header_logo', 'footer_logo', 'og_image'),
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
            'og_image' => $og_image,
        ]);
    }

    public function update(ProjectUpdateRequest $request, Project $data) : void
    {
        if($request->hasFile('header_logo')){
            $header_logo = (new FileService)->save_file($request, 'header_logo', $this->path);
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->header_logo);
            $data->update([
                'header_logo' => $header_logo,
            ]);
        }
        if($request->hasFile('footer_logo')){
            $footer_logo = (new FileService)->save_file($request, 'footer_logo', $this->path);
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->footer_logo);
            $data->update([
                'footer_logo' => $footer_logo,
            ]);
        }
        if($request->hasFile('og_image')){
            $og_image = (new FileService)->save_file($request, 'og_image', $this->path);
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->og_image);
            $data->update([
                'og_image' => $og_image,
            ]);
        }
        $data->update([
            ...$request->except('header_logo', 'footer_logo', 'og_image'),
        ]);
    }

    public function delete(Project $data): void
    {
        (new FileService)->delete_file('app/'.$this->path.'/'.$data->header_logo);
        (new FileService)->delete_file('app/'.$this->path.'/'.$data->footer_logo);
        if(!empty($data->og_image)){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->og_image);
        }
        $data->delete();
    }
}
