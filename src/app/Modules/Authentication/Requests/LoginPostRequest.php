<?php

namespace App\Modules\Authentication\Requests;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;

class LoginPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = $this->safe()->only('email', 'password');
        $request['userType'] = UserStatusEnum::ACTIVE->label();
        $request['status'] = RoleEnum::ADMIN->label();
        $this->replace(Purify::clean($request));
    }
}
