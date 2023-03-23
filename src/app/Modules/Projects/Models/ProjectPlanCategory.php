<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlanCategory extends Model
{
    use HasFactory;

    protected $table = 'project_plan_category_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'project_id',
    ];

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }

    public function ProjectPlanImage()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectPlanImage', 'plan_category_id');
    }
}
