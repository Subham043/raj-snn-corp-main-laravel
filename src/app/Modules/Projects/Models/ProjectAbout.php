<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectAbout extends Model
{
    use HasFactory;

    protected $table = 'project_about_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rera',
        'left_image',
        'about_logo',
        'description',
        'project_id',
    ];

    protected $appends = ['about_logo_link', 'left_image_link'];

    protected function aboutLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_about/'.$this->about_logo),
        );
    }

    protected function leftImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects_about/'.$this->left_image),
        );
    }

    public function Project()
    {
        return $this->belongsTo('App\Modules\Projects\Models\Project', 'project_id')->withDefault();
    }
}
