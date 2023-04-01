<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectGallery extends Model
{
    use HasFactory;

    protected $table = 'project_gallery_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'project_id',
    ];

    protected $appends = ['image_link'];

    protected function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_gallery/'.$this->image),
        );
    }

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
