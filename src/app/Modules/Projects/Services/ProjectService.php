<?php

namespace App\Modules\Projects\Services;

use App\Enums\PublishStatusEnum;
use App\Http\Services\FileService;
use App\Modules\Projects\Models\Project;
use App\Modules\Projects\Requests\ProjectCreateRequest;
use App\Modules\Projects\Requests\ProjectUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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
        return $this->projectModel->orderBy('id', 'DESC')->get();
    }

    public function paginate(Request $request, Int $limit = 10): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->projectModel->where('name', 'like', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->projectModel->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getById(Int $id): Project
    {
        return $this->projectModel->findOrFail($id);
    }

    public function getBySlug(String $slug): Project
    {
        return $this->projectModel->with(['ProjectAbout', 'ProjectGallery', 'ProjectAmenities', 'ProjectLocation', 'ProjectTable', 'ProjectPlanCategory.ProjectPlanImage', 'ProjectBanner', 'ProjectConnectivity'])->where('publish_status', PublishStatusEnum::ACTIVE->label())->where('slug', $slug)->firstOrFail();
    }

    public function getPreview(Int $id): Project
    {
        return $this->projectModel->with(['ProjectAbout', 'ProjectGallery', 'ProjectAmenities', 'ProjectLocation', 'ProjectTable', 'ProjectPlanCategory.ProjectPlanImage', 'ProjectBanner', 'ProjectConnectivity'])->findOrFail($id);
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

    public function updateHeading(array $value, Project $data) : void
    {
        $data->update([
            ...$value,
        ]);
    }

    public function update(ProjectUpdateRequest $request, Project $data) : void
    {
        $data->update([
            ...$request->except('header_logo', 'footer_logo', 'og_image'),
        ]);
    }

    public function update_image(ProjectUpdateRequest $request, Project $data) : void
    {
        if($request->hasFile('header_logo')){
            $header_logo = (new FileService)->save_file($request, 'header_logo', $this->path);
            if($data->header_logo){
                (new FileService)->delete_file('app/'.$this->path.'/'.$data->header_logo);
            }
            $data->update([
                'header_logo' => $header_logo,
            ]);
        }
        if($request->hasFile('footer_logo')){
            $footer_logo = (new FileService)->save_file($request, 'footer_logo', $this->path);
            if($data->footer_logo){
                (new FileService)->delete_file('app/'.$this->path.'/'.$data->footer_logo);
            }
            $data->update([
                'footer_logo' => $footer_logo,
            ]);
        }
        if($request->hasFile('og_image')){
            $og_image = (new FileService)->save_file($request, 'og_image', $this->path);
            if($data->og_image){
                (new FileService)->delete_file('app/'.$this->path.'/'.$data->og_image);
            }
            $data->update([
                'og_image' => $og_image,
            ]);
        }
    }

    public function delete(Project $data): void
    {
        if($data->header_logo){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->header_logo);
        }
        if($data->footer_logo){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->footer_logo);
        }
        if(!empty($data->og_image)){
            (new FileService)->delete_file('app/'.$this->path.'/'.$data->og_image);
        }
        $data->delete();
    }
}
