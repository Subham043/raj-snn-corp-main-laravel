<?php

namespace App\Modules\Authentication\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ExtendedUser extends User
{

    protected $attributes = [
        'status' => 0,
        'userType' => 2,
    ];

    protected $appends = ['account_status', 'role'];

    protected function getPassword(){
        return $this->password;
    }

    protected function accountStatus(): Attribute
    {
        return new Attribute(
            get: fn () => UserStatusEnum::getValue($this->status),
        );
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn () => RoleEnum::getValue($this->userType),
        );
    }
}
