<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
