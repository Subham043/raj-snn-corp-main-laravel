<?php

namespace App\Modules\Authentication\Requests;

use App\Modules\Authentication\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;

class ForgotPasswordPostRequest extends FormRequest
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
            'email' => ['required','string','email','max:255', function ($attribute, $value, $fail) {
                try {
                    //code...
                    $this->authService->getByEmail($value);
                } catch (\Throwable $th) {
                    //throw $th;
                    $fail('The '.$attribute.' does not exists!.');
                }
            }],
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = $this->safe()->only('email');
        $request['otp'] = rand(1000,9999);
        $this->replace(Purify::clean($request));
    }
}
