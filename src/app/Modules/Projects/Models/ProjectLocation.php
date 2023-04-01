<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectLocation extends Model
{
    use HasFactory;

    protected $table = 'project_location_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'description',
        'map_image',
        'project_id',
    ];

    protected $appends = ['map_image_link'];

    protected function mapImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_location/'.$this->map_image),
        );
    }

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
