<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('food_categories')->insert([
           ['name' => 'Barbeque','created_at' => now(),'updated_at' => now()],
            ['name' => 'Pizza','created_at' => now(),'updated_at' => now()],
            ['name' => 'Pasta','created_at' => now(),'updated_at' => now()],
            ['name' => 'Burger','created_at' => now(),'updated_at' => now()],
            ['name' => 'Salad','created_at' => now(),'updated_at' => now()]
        ]);
    }
}
