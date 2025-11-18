<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLeave extends Model
{
    //
    protected $fillable = [
        'member_id',
        'date',
        'start_date',
        'end_date',
        'reason',
        'photo',
        'status',
        'type',
        'type_leave',
        'approve_by',
        'approve_date',
    ];
    public function typeLeave(){
        return $this->belongsTo(TypeLeave::class, 'type_leave');
    }

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
