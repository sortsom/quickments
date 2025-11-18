<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'member_id',
        'start_time',
        'end_time',
        'start_time2',
        'end_time2',
        'date',
        'status',
        'half_time',
    ];
}
