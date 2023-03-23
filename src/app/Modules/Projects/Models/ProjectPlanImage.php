<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlanImage extends Model
{
    use HasFactory;

    protected $table = 'project_plan_image_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'plan_category_id',
    ];

    public function ProjectPlanCategory()
    {
        return $this->belongsTo('App\Modules\Projects\Models\ProjectPlanCategory', 'plan_category_id')->withDefault();
    }
}
