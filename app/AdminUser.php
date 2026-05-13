<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    protected $table = 'admin_users';
    protected $fillable = [
    	'name',
    	'email',
    	'password',
        'darkmode',
        'view_userpage',
        'created_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
