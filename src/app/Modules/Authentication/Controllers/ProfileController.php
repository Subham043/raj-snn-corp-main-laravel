<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Requests\ForgotPasswordPostRequest;
use App\Modules\Authentication\Services\AuthService;

class ProfileController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        return view('admin.pages.profile.index');
    }

    public function post(ForgotPasswordPostRequest $request){

        try {
            //code...
            $encryptedId = $this->authService->forgot_password($request->all());

            return redirect(route('reset_password.get',$encryptedId))->with('success_status', 'Kindly check your mail, we have sent you the otp.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('forgot_password.get'))->with('error_status', 'Oops! You have entered invalid credentials');
        }

    }
}
