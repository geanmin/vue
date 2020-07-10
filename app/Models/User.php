<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasRoles;
    protected $guard_name = 'web'; // or whatever guard you want to use

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'status',
        'api_token'
    ];
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];
}
