<?php

use App\Models\ActivityLog;

if (!function_exists('logActivity')) {
    function logActivity($action, $description = null,$userId = null)
    {
        $userId = $userId ?? session('user_id') ?? null;

        if ($userId) {
            ActivityLog::create([
                'user_id' => $userId,
                'action' => $action,
                'description' => $description
            ]);
        }
    }
}
