<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectSpecification extends Model
{
    use HasFactory;

    protected $table = 'project_specification_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'icon_image',
        'project_id',
    ];

    protected $appends = ['icon_image_link'];

    protected function iconImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_specification/'.$this->icon_image),
        );
    }

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
