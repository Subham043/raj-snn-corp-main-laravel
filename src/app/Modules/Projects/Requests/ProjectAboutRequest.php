<?php

namespace App\Modules\Projects\Requests;

use App\Modules\Projects\Models\ProjectAbout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rule;


class ProjectAboutRequest extends FormRequest
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
            'rera' => 'required|string|max:500',
            'description' => 'required|string',
            'about_logo' => ['image','mimes:jpeg,png,jpg,webp,avif', Rule::requiredIf(function (){
                $about = ProjectAbout::where('project_id', $this->route('project_id'))->first();
                return empty($about->about_logo);
            })],
            'left_image' => ['image','mimes:jpeg,png,jpg,webp,avif', Rule::requiredIf(function (){
                $about = ProjectAbout::where('project_id', $this->route('project_id'))->first();
                return empty($about->left_image);
            })],
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
            'rera' => 'Rera Number',
            'left_image' => 'Left Image',
            'about_logo' => 'About Logo',
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
        $this->replace(Purify::clean($request));
    }
}
