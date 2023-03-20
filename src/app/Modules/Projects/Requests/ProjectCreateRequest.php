<?php

namespace App\Modules\Projects\Requests;

use App\Enums\ProjectStatusEnum;
use App\Enums\PublishStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class ProjectCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:250|unique:projects,slug',
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
            'header_logo' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'footer_logo' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'project_status' => 'nullable',
            'publish_status' => 'nullable',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Project Name',
            'email' => 'Project Email',
            'phone' => 'Project Phone',
            'address' => 'Project Address',
            'og_image' => 'Og Image',
            'header_logo' => 'Header Logo',
            'footer_logo' => 'Footer Logo',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = $this->validated();
        $request['project_status'] = empty($request['project_status']) ? ProjectStatusEnum::COMPLETED->label() : ($request['project_status'] == "on" ? ProjectStatusEnum::UPCOMING->label() : ProjectStatusEnum::COMPLETED->label());
        $request['publish_status'] = empty($request['publish_status']) ? PublishStatusEnum::DRAFT->label() : ($request['publish_status'] == "on" ? PublishStatusEnum::ACTIVE->label() : PublishStatusEnum::DRAFT->label());
        $this->replace(Purify::clean($request));
    }
}
