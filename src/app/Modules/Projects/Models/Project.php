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
        'table_heading',
        'table_main_heading',
        'gallery_heading',
        'specification_heading',
        'plan_heading',
        'location_heading',
        'connectivity_heading',
        'amenities_heading',
    ];

    protected $attributes = [
        'project_status' => 1,
        'publish_status' => 1,
        'table_heading' => 'Double Height Ceilings & <span>18 Feet Tall Windows</span>',
        'table_main_heading' => 'Raj Viviente by SNN Raj Corp <bt/>Luxury 4BHK Villas Off Bannerghatta Rd',
        'gallery_heading' => 'Image <span>Gallery</span>',
        'specification_heading' => 'Villas With Design Influences From <span>10+ Countries</span>',
        'plan_heading' => 'Master & <span>Unit Plans</span>',
        'location_heading' => 'Prime <span>Location</span>',
        'connectivity_heading' => 'Connectivity <span>At Its Best</span>',
        'amenities_heading' => '20+ Worldclass <span>Amenities</span>',
    ];

    protected $appends = ['project_status_type', 'publish_status_type', 'header_logo_link', 'footer_logo_link', 'og_image_link'];

    protected function projectStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => ProjectStatusEnum::getValue($this->project_status),
        );
    }

    protected function publishStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => PublishStatusEnum::getValue($this->project_status),
        );
    }

    protected function headerLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects/'.$this->header_logo),
        );
    }

    protected function footerLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/public/upload/projects/'.$this->footer_logo),
        );
    }

    protected function ogImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => !empty($this->og_image) ? asset('storage/public/upload/projects/'.$this->og_image): null,
        );
    }

    public function ProjectBanner()
    {
        return $this->hasOne('App\Modules\Projects\Models\ProjectBanner', 'project_id');
    }

    public function ProjectAbout()
    {
        return $this->hasOne('App\Modules\Projects\Models\ProjectAbout', 'project_id');
    }

    public function ProjectLocation()
    {
        return $this->hasOne('App\Modules\Projects\Models\ProjectLocation', 'project_id');
    }

    public function ProjectAmenities()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectAmenities', 'project_id');
    }

    public function ProjectTable()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectTable', 'project_id');
    }

    public function ProjectConnectivity()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectConnectivity', 'project_id');
    }

    public function ProjectPlanCategory()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectPlanCategory', 'project_id');
    }

    public function ProjectSpecification()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectSpecification', 'project_id');
    }

    public function ProjectGallery()
    {
        return $this->hasMany('App\Modules\Projects\Models\ProjectGallery', 'project_id');
    }
}
