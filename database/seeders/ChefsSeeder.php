<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChefsSeeder extends Seeder
{

    public function run(): void
    {
        Chef::factory()->count(5)->create();
    }
}
