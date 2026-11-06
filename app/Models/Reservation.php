<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'table_id',
        'date_and_time_start',
        'date_and_time_end',
        'description',
        'status'
    ];

    protected static function booted(){
        static::created(function ($reservation) {
            logActivity('Reservation Created','Reservation : '.$reservation->id.'created on '.$reservation->date_and_time_start.' on table with id '.$reservation->table_id.'.',$reservation->user_id);
        });
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function table(){
        return $this->belongsTo('App\Models\Table');
    }
}
