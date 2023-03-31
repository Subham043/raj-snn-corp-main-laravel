<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Services\AuthService;
use App\Modules\Authentication\Requests\PasswordPostRequest;

class PasswordUpdateController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function post(PasswordPostRequest $request)
    {
        try {
            //code...
            $this->authService->password_update($request->all());
            return response()->json(["message" => "Password Updated successfully."], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["error"=>"something went wrong. Please try again"], 400);
        }

    }
}
