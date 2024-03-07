<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class EmployeeMaster  extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';
    use HasFactory;
    protected $table = 'employee_master';

    protected $fillable = [
        'employee_name',
        'employee_code',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'address',
        'country',
        'state',
        'city',
        'zip',
    ];
}
