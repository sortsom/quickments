<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'name_kh',
        'gender',
        'dob',
        'photo',
        'position',
        'phone',
        'address',
        'status',
        'user_id',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function worktimes()
    {
        return $this->hasMany(Worktime::class, 'member_id');
    }
    
}
