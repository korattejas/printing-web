<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveMaster extends Model
{
    use HasFactory;
    protected $table = 'leave_master';
    protected $fillable = [
        'leaveType',
    ];
}
