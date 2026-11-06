<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];

    public function logActivity($action,$description = null,$userId = null){
        ActivityLog::create([
            'user_id' => $userId ?? session('user_id'),
            'action' => $action,
            'description' => $description,
        ]);
    }
}
