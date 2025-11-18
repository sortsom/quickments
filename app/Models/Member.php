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
    ];

    protected $casts = [
        'dob' => 'date',
    ];
    
}
