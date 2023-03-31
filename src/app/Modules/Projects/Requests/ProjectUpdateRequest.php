<?php

namespace App\Modules\Projects\Requests;

use Stevebauman\Purify\Facades\Purify;
use App\Enums\ProjectStatusEnum;
use App\Enums\PublishStatusEnum;


class ProjectUpdateRequest extends ProjectCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:250|unique:projects,slug,'.$this->route('id'),
            'phone' => 'nullable|integer|digits:10',
            'email' => 'nullable|string|email|max:255',
            'address' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_locale' => 'nullable|string',
            'og_type' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_site_name' => 'nullable|string',
            'meta_header' => 'nullable|string',
            'meta_footer' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'project_status' => 'nullable',
            'publish_status' => 'nullable',
        ];
    }

}
