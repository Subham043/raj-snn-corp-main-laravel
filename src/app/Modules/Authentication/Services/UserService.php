<?php

namespace App\Modules\Authentication\Services;

use App\Exceptions\UserAccessException;
use App\Http\Services\DecryptService;
use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function all(): Collection
    {
        return $this->userModel->all();
    }

    public function getById(Int $id): User
    {
        return $this->userModel->findOrFail($id);
    }

    public function getByEmail(String $email): User
    {
        return $this->userModel->where('email', $email)->firstOrFail();
    }

    public function hasAccess(User $user): void
    {
        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
        }
    }

    public function reset_password(array $data, String $user_id): void
    {
        # code...
        $user = $this->getById(
            (new DecryptService)->decryptId($user_id)
        );

        // $this->hasAccess($user);

        $user->update([
            ...$data
        ]);
    }

}
