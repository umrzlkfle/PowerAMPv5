<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class
        ]);
        
        // Create a default user
        User::factory()->create([
            'name' => 'admin base',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret'),
            'role' => 'admin'
        ]);
    }
}
