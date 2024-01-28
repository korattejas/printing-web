<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'image',
        'mobile_number',
        'email_verified_at',
        'password',
        'status',
        'role',
        'is_deleted',
        'is_last_login_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
