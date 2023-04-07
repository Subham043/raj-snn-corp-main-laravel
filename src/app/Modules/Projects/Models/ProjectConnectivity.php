<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectConnectivity extends Model
{
    use HasFactory;

    protected $table = 'project_connectivity_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'points',
        'project_id',
    ];

    protected $appends = ['points_list'];

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
