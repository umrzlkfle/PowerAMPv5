<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader; // You might need to install 'league/csv' if not already present

class SubstationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to your CSV file. Make sure this path is correct.
        // It's often good practice to place seed data in a 'data' folder
        // within your database directory, or ensure the path is absolute.
        $csvFile = database_path('seeders/data/PPUSSU_processed.csv'); // Adjust path as needed

        // Check if the file exists
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        // Using League\Csv for robust CSV parsing
        // If you don't have it, install with: composer require league/csv
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Assuming the first row is the header

        $records = $csv->getRecords();

        // Clear existing data to avoid duplicates on re-seeding
        // Important: This will remove all current data from the 'substations' table!
        DB::table('substations')->truncate(); 

        foreach ($records as $record) {
            DB::table('substations')->insert([
                'substation_id' => $record['Id'], // Mapped from CSV 'Id'
                'status' => $record['Status'],
                'name' => $record['Name'],
                'owner_type' => $record['Owner_Type'],
                'owner_name' => $record['Owner_Name'],
                'design' => $record['Design'],
                'voltage' => $record['Voltage'],
                'functional_location' => $record['FL'], // Mapped from CSV 'FL'
                'operational_area' => $record['Op_Area'], // Mapped from CSV 'Op_Area'
                'category' => $record['Category'],
                'status_act' => $record['Status_act'],
                'latitude' => (double) $record['Latitude'], // Cast to double for decimal precision
                'longitude' => (double) $record['Longitude'], // Cast to double for decimal precision
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Substations table seeded successfully!');
    }
}