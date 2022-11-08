<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guarded;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this
            ->Belongsto(Role::class, 'role_id');
    }



    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
