<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class EmployeeLeaveMaster  extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';
    use HasFactory;
    protected $table = 'employee_leave_master';

    protected $fillable = [
        'leave_type',
        'employee_code',
        'from_date',
        'to_date',
        'number_of_days',
        'comment',
    ];
}
