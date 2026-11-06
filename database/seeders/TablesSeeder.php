<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smoking = Area::where('name', 'Smoking')->first()->id;
        $nonSmoking = Area::where('name', 'Non-smoking')->first()->id;
        $garden = Area::where('name', 'Garden')->first()->id;

        Table::insert([
            ['number' => 1, 'seat_number' => 4, 'area_id' => $smoking, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 2, 'seat_number' => 2, 'area_id' => $smoking, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 3, 'seat_number' => 6, 'area_id' => $smoking, 'created_at' => now(), 'updated_at' => now()],

            ['number' => 4, 'seat_number' => 4, 'area_id' => $nonSmoking, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 5, 'seat_number' => 2, 'area_id' => $nonSmoking, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 6, 'seat_number' => 8, 'area_id' => $nonSmoking, 'created_at' => now(), 'updated_at' => now()],

            ['number' => 7, 'seat_number' => 4, 'area_id' => $garden, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 8, 'seat_number' => 6, 'area_id' => $garden, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 9, 'seat_number' => 2, 'area_id' => $garden, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 10, 'seat_number' => 8, 'area_id' => $garden, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
