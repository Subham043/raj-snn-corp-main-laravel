<?php

namespace App\Modules\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Projects\Models\ProjectPlanImage;
use App\Modules\Projects\Requests\ProjectPlanImageRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectPlanImageService
{
    private $projectPlanImageModel;
    private $path = 'public/upload/projects_plan_image';

    public function __construct(ProjectPlanImage $projectPlanImageModel)
    {
        $this->projectPlanImageModel = $projectPlanImageModel;
    }

    public function getById(Int $id): ProjectPlanImage
    {
        return $this->projectPlanImageModel->findOrFail($id);
    }

    public function paginate(Int $limit = 10, Int $plan_category_id): LengthAwarePaginator
    {
        return $this->projectPlanImageModel->where('plan_category_id', $plan_category_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(ProjectPlanImageRequest $request, Int $plan_category_id): void
    {
        $image = (new FileService)->save_file($request, 'image', $this->path);
        $this->projectPlanImageModel->create([
            'image' => $image,
            'plan_category_id' => $plan_category_id,
        ]);
    }

    public function delete(ProjectPlanImage $data): void
    {
        (new FileService)->delete_file('app/'.$this->path.'/'.$data->image);
        $data->delete();
    }

}
