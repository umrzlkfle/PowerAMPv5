<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ali Imran',
            'email' => 'aliimran@gmail.com',
            'role' => 'admin',
            'password' => '123456789',
        ]);

        User::create([
            'name' => 'Andi Aqil',
            'email' => 'andiaqil@gmail.com',
            'role' => 'admin',
            'password' => '123456789',
        ]);

        User::create([
            'name' => 'Izzat Hatta',
            'email' => 'izzathatta@gmail.com',
            'role' => 'admin',
            'password' => '123456789',
        ]);

            User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => '',
        ]);
    }
}
