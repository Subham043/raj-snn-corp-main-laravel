<?php

namespace App\Modules\Authentication\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Services\DecryptService;
use App\Modules\Authentication\Models\User;
use Illuminate\Support\Facades\Crypt;

class AuthService extends UserService
{
    public function __construct(User $userModel)
    {
       parent::__construct($userModel);
    }

    public function encrypted_data($data): string {
        return Crypt::encryptString($data);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function forgot_password(array $request): string
    {
        $user = $this->getByEmail($request['email']);
        // $this->hasAccess($user);
        $user->update([
            'otp' => $request['otp'],
        ]);
        return $this->encrypted_data($user->id);
    }


    public function auth_user_details(): User
    {
        return Auth::user();
    }

    public function send_otp(String $id): User
    {
        $decryptedId = (new DecryptService)->decryptId($id);
        $user = $this->getById($decryptedId);
        $user->update([
            'otp' => rand(1000,9999),
        ]);

        return $user;
    }

    public function profile_update(array $data): User
    {
        $user = $this->getById($this->auth_user_details()->id);
        $user->update([
            ...$data
        ]);
        return $user;
    }

    public function password_update(array $data): User
    {
        $user = $this->getById($this->auth_user_details()->id);
        $user->update([
            ...$data
        ]);
        return $user;
    }
}
