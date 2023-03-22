<?php

namespace App\Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\ProjectStatusEnum;
use App\Enums\PublishStatusEnum;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'header_logo',
        'footer_logo',
        'address',
        'email',
        'phone',
        'meta_title',
        'meta_description',
        'og_locale',
        'og_type',
        'og_description',
        'og_site_name',
        'og_image',
        'meta_header',
        'meta_footer',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'project_status',
        'publish_status',
    ];

    protected $attributes = [
        'project_status' => 1,
        'publish_status' => 1,
    ];

    protected $appends = ['project_status_type', 'publish_status_type'];

    protected function projectStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => ProjectStatusEnum::getValue($this->status),
        );
    }

    protected function publishStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => PublishStatusEnum::getValue($this->userType),
        );
    }

    public function ProjectAbout()
    {
        return $this->hasOne('App\Modules\Projects\Models\ProjectAbout', 'project_id');
    }
}
