<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OvertimeWork extends Model
{
    //
    protected $fillable = [
        'member_id',
        'date',
        'start_time',
        'end_time',
        'reason',
        'photo',
        'status',
        'approve_by',
        'approve_date',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }   
    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }
}
