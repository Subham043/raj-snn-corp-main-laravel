<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectBanner extends Model
{
    use HasFactory;

    protected $table = 'project_banner_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'banner_image',
        'heading',
        'sub_heading',
        'points',
        'project_id',
    ];

    protected $appends = ['banner_image_link', 'points_list'];

    protected function bannerImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_banner/'.$this->banner_image),
        );
    }

    protected function pointsList(): Attribute
    {
        return new Attribute(
            get: fn () => explode("|",$this->points),
        );
    }

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
