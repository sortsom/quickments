<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLeave extends Model
{
    //
    protected $fillable = [
        'user_id',
        'member_id',
        'date',
        'start_time',
        'end_time',
        'reason',
        'photo',
        'status',
        'type',
        'type_leave',
        'approve_by',
        'approve_date',
    ];

protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];


    public function typeLeave()
{
    return $this->belongsTo(LeaveType::class, 'type_leave');
}

// better name: status()
public function status()
{
    return $this->belongsTo(Status::class, 'status'); // FK column = status
}

public function member()
{
    return $this->belongsTo(Member::class, 'member_id');
}

public function approver()
{
    return $this->belongsTo(User::class, 'approve_by');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
