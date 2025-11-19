<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    //
    protected $fillable = [
        'member_id',
        'day',
        'start_time',
        'end_time',
        'start_time2',
        'end_time2',
        'half_day',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }   
    public function weekly()
    {
         return $this->belongsTo(Weekly::class);
    }
}
