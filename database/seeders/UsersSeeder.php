<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        $admin = Role::where('name','admin')->first()->id;
        $user = Role::where('name','user')->first()->id;

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin123'),
            'role_id' => $admin,
        ]);
        User::create([
            'first_name' => 'Andrija',
            'last_name' => 'Zdravkovic',
            'email' => 'andrija@test.com',
            'password' => bcrypt('andrija123'),
            'role_id' => $user,
        ]);
        User::create([
            'first_name' => 'Marko',
            'last_name' => 'Aleksic',
            'email' => 'marko@test.com',
            'password' => bcrypt('marko123'),
            'role_id' => $user,
        ]);
        User::factory()->count(10)->create();
    }
}
