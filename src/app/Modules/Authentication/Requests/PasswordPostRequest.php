<?php

namespace App\Modules\Authentication\Requests;

use Stevebauman\Purify\Facades\Purify;
use App\Modules\Authentication\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordPostRequest extends FormRequest
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required','string','min:6', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->authService->auth_user_details()->getPassword())) {
                    $fail('The '.$attribute.' entered is incorrect.');
                }
            }],
            'password' => ['required',
                'string',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
            ],
            'confirm_password' => 'string|min:6|required_with:password|same:password',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = $this->safe()->only('old_password', 'password');
        $this->replace(
            Purify::clean(
                [
                    'password' => Hash::make($request['password'])
                ]
            )
        );
    }
}
