<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $fillable=[
        'user_id',
        'role',
    ];
    public function roles()
    {
    return $this->hasMany(Role::class);
    }

}
