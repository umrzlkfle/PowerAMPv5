<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader; // Ensure this is installed: composer require league/csv

class AssetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The memory limit is typically configured in your php.ini file (for CLI).
        // Removing explicit ini_set here to rely on the global PHP settings.
        // If you encounter memory issues again, increase 'memory_limit' in your php.ini for CLI.

        $csvFile = database_path('seeders/data/MCMS33KV_processed.csv');

        // Check if the CSV file exists
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        try {
            // Create a CSV Reader instance from the file path
            $csv = Reader::createFromPath($csvFile, 'r');
            // Set the first row as the header, so records can be accessed by column name
            $csv->setHeaderOffset(0);

            // Truncate the 'assets' table to clear any existing data.
            // This is faster than deleting row by row.
            DB::table('assets')->truncate();

            $data = []; // Array to hold data for batch insertion
            $chunkSize = 5000; // Define the number of records to insert in each batch.
                               // Adjust this value based on your server's memory and performance.
                               // Larger chunks mean fewer queries but more memory per batch.

            // Iterate directly over the CSV records. League\Csv's getRecords() returns an iterator,
            // which is memory-efficient as it doesn't load all records into memory at once.
            foreach ($csv->getRecords() as $record) {
                // Map CSV columns to database table columns.
                // Use null coalescing operator (?? null) to handle potentially missing CSV columns
                // without throwing errors.
                $data[] = [
                    'functional_location' => $record['Functional Location'] ?? null,
                    'description' => $record['Description'] ?? null,
                    'sap_functional_location' => $record['SAP Functional Location'] ?? null,
                    'status' => $record['Status'] ?? null,
                    'vertical' => 'Vertical', // Default value or read from CSV if available
                    'subvertical' => $record['Subvertical'] ?? null,
                    'location_category' => $record['Location Category'] ?? null,
                    'voltage_level' => $record['Voltage Level'] ?? null,
                    'business_area' => $record['Business Area'] ?? null,
                    'maintenance_work_center' => $record['Maint. Work Center'] ?? null,
                    'station_area' => $record['Station/Area'] ?? null,
                    'created_at' => now(), // Use Laravel's helper for current timestamp
                    'updated_at' => now(), // Use Laravel's helper for current timestamp
                ];

                // If the accumulated data count reaches the defined chunk size,
                // perform a batch insert into the database.
                if (count($data) >= $chunkSize) {
                    DB::table('assets')->insert($data);
                    $data = []; // Clear the array to free up memory for the next chunk
                }
            }

            // After the loop, insert any remaining records that did not form a full chunk.
            if (!empty($data)) {
                DB::table('assets')->insert($data);
            }

            // Inform the user that the seeding process was successful
            $this->command->info('Assets table seeded successfully!');

        } catch (\Exception $e) {
            // Catch and report any exceptions that occur during file processing or database operations.
            $this->command->error("Error seeding assets: " . $e->getMessage());
            // For detailed debugging, you might log $e->getTraceAsString() here.
        }
    }
}
