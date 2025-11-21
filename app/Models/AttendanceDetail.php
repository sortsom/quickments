<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceDetail extends Model
{
    //
    protected $fillable = [
        'attendance_id',
        'clock',
        'check_type',
        'status',
        'reason',
        'count_time',
    ];
     public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
