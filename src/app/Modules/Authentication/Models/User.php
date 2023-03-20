<?php

namespace App\Modules\Authentication\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'otp',
        'status',
        'userType',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 0,
        'userType' => 2,
    ];

    protected $appends = ['account_status', 'role'];

    public function getPassword(){
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
