<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('email','marko@test.com')->firstOrFail()->id;
        $user2 = User::where('email','andrija@test.com')->firstOrFail()->id;

        $table1 = Table::where('number',1)->firstOrFail()->id;
        $table2 = Table::where('number',5)->firstOrFail()->id;
        $table3 = Table::where('number',7)->firstOrFail()->id;

        Reservation::insert([
            [
                'user_id' => $user1,
                'table_id' => $table1,
                'date_and_time_start' => now()->addDays(1)->setTime(18, 0),
                'date_and_time_end' => now()->addDays(1)->setTime(21, 0),
                'description' => null,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => $user1,
                'table_id' => $table2,
                'date_and_time_start' => now()->addDays(2)->setTime(20, 0),
                'date_and_time_end' => now()->addDays(2)->setTime(23, 0),
                'description' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => $user2,
                'table_id' => $table3,
                'date_and_time_start' => now()->addDays(1)->setTime(19, 30),
                'date_and_time_end' => now()->addDays(1)->setTime(22, 30),
                'description' => null,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => $user2,
                'table_id' => $table1,
                'date_and_time_start' => now()->addDays(3)->setTime(21, 0),
                'date_and_time_end' => now()->addDays(3)->setTime(24, 0),
                'description' => null,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
