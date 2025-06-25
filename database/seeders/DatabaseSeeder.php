<?php

namespace Database\Seeders;

use App\Models\BreakdownRecord;
use App\Models\Substation;
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
            UserTableSeeder::class,
            // SubstationTableSeeder::class,
            // CableTableSeeder::class,
            AssetTableSeeder::class,
            BreakdownRecordsTableSeeder::class,
            MaintenanceRecordsTableSeeder::class,
        ]);
        
// Create default users
User::factory()->create([
    'name' => 'admin base',
    'email' => 'admin@tnb.com',
    'password' => Hash::make('secret'),
    'role' => 'admin'
]);

User::create([
    'name' => 'Izzat Hatta',
    'email' => 'izzathatta@tnb.com',
    'role' => 'staff',
    'password' => Hash::make('123456789'), // Added Hash::make for password security
]);
    }
}