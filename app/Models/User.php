<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'password',
      'role_id'
    ];

    protected static function booted(){
        static::created(function($user){
            logActivity('New user registered','User ID:' . $user->id,$user->id);
        });
    }
}
