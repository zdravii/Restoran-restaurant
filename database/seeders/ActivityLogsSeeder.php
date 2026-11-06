<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activity_logs')->insert([
            [
                'user_id' => 2,
                'action' => 'User registered',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'action' => 'User logged in',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'action' => 'User logged in',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'action' => 'User created reservation',
                'description' => 'User created reservation for 3 people,table number 2,date : 27.03.2026 at 18:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'action' => 'User logged out',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'action' => 'User logged out',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
