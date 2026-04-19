<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Seller extends Model
{
    use HasApiTokens, HasRoles, Notifiable;
    
    protected $table = 'seller';
    protected $guard_name = 'seller';
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'token_expiry',
    ];
}
