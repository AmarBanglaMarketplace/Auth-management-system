<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Agent extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;
    protected $guard_name = 'agent';

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
