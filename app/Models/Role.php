<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable =[
        'name'
    ];

   //1 role memiliki banyak user 
    public function user() {
        return $this->hasMany(User::class,'role_id');
    }

}
