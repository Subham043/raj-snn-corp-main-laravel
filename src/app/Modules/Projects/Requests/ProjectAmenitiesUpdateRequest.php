<?php

namespace App\Modules\Projects\Requests;


class ProjectAmenitiesUpdateRequest extends ProjectAmenitiesCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:500',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
        ];
    }
}
