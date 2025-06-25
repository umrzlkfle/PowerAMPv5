<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader; // Make sure you have 'league/csv' installed: composer require league/csv

class CableTableSeeder extends Seeder // Seeder class name changed
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to your CSV file. Adjust this path if your file is in a different location.
        // e.g., database/seeders/data/MVUGKedah_processed.csv
        $csvFile = database_path('seeders/data/MVUGKedah_processed.csv'); 

        // Check if the file exists
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        // Using League\Csv for robust CSV parsing
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Assuming the first row is the header

        $records = $csv->getRecords();

        // Clear existing data to avoid duplicates on re-seeding
        // WARNING: This will remove all current data from the 'cables' table!
        DB::table('cables')->truncate(); // Table name changed to 'cables'

        // Insert data in chunks to prevent memory issues with large CSV files
        $chunkSize = 1000; 
        $data = [];

        foreach ($records as $record) {
            $data[] = [
                'Id' => $record['Id'],
                'Circ_id' => $record['Circ_id'],
                'Status' => $record['Status'],
                'Phasing' => $record['Phasing'],
                'Voltage' => $record['Voltage'],
                'Class' => $record['Class'],
                'Owner_Type' => $record['Owner_Type'],
                'Owner_Name' => $record['Owner_Name'],
                'From_Info' => $record['From_Info'],
                'To_Info' => $record['To_Info'],
                'Label' => $record['Label'],
                'Op_Area' => $record['Op_Area'],
                'SubstationLabel' => $record['SubstationLabel'],
                'FromToName' => $record['FromToName'],
                'FromLabel' => $record['FromLabel'],
                'ToLabel' => $record['ToLabel'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data in chunks
            if (count($data) >= $chunkSize) {
                DB::table('cables')->insert($data); // Table name changed to 'cables'
                $data = []; // Clear the array for the next chunk
            }
        }

        // Insert any remaining data
        if (!empty($data)) {
            DB::table('cables')->insert($data); // Table name changed to 'cables'
        }

        $this->command->info('Cables table seeded successfully!');
    }
}