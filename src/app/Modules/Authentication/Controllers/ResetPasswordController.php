<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Modules\Authentication\Requests\ResetPasswordPostRequest;
use App\Modules\Authentication\Services\AuthService;

class ResetPasswordController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get($user_id){
        $this->authService->getById((new DecryptService)->decryptId($user_id));
        return view('admin.pages.auth.reset_password')->with([
            'encryptedId' => $user_id,
        ]);
    }

    public function post(ResetPasswordPostRequest $request, $user_id){

        try {
            //code...
            $this->authService->reset_password($request->all(), $user_id);

            return redirect(route('login.get'))->with('success_status', 'Password Reset Successful.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('reset_password.get',$user_id))->with('error_status', 'Oops! Invalid OTP');
        }

    }
}
