<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Requests\LoginPostRequest;
use App\Modules\Authentication\Services\AuthService;

class LoginController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        return view('admin.pages.auth.login');
    }

    public function post(LoginPostRequest $request){

        $is_authenticated = $this->authService->login($request->all());

        if ($is_authenticated) {
            return redirect()->intended(route('profile.get'))->with('success_status', 'Logged in successfully.');
        }

        return redirect(route('login.get'))->with('error_status', 'Oops! You have entered invalid credentials');
    }
}
