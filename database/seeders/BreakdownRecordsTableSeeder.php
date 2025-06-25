<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader; // Ensure this is installed: composer require league/csv
use Carbon\Carbon; // For handling date and time parsing

class BreakdownRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the path to your CSV file.
        // Make sure 'tripping_data.csv' is in database/seeders/data/
        $csvFile = database_path('seeders/data/FOMS_processed.csv');

        // Define the expected date and time format from your CSV
        // This matches 'DD/MM/YYYY HH:MM'
        $dateTimeFormat = 'd/m/Y H:i';

        // Check if the CSV file exists before proceeding
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        try {
            // Create a CSV Reader instance from the file path
            $csv = Reader::createFromPath($csvFile, 'r');
            // Set the first row of the CSV as the header.
            // This allows you to access data by column names (e.g., $record['Tripping ID']).
            $csv->setHeaderOffset(0);

            // Truncate the 'breakdown_records' table to clear any existing data.
            // This is generally faster than deleting rows one by one for a clean seed.
            DB::table('breakdown_records')->truncate();

            $data = []; // Array to store records before batch insertion
            $chunkSize = 1000; // Number of records to insert in each batch.
                               // Adjust this value based on your server's memory and the size of your CSV.
                               // Larger chunks mean fewer database queries but higher temporary memory usage.

            // Iterate over each record in the CSV file.
            // League\Csv's getRecords() method returns an iterator, which is memory-efficient
            // as it doesn't load the entire file into memory at once.
            foreach ($csv->getRecords() as $record) {
                // Helper function to safely parse dates
                $parseDate = function ($dateString) use ($dateTimeFormat) {
                    if (empty($dateString)) {
                        return null;
                    }
                    try {
                        return Carbon::createFromFormat($dateTimeFormat, $dateString);
                    } catch (\Exception $e) {
                        $this->command->warn("Could not parse date '{$dateString}' with format '{$dateTimeFormat}': " . $e->getMessage());
                        return null; // Return null if parsing fails
                    }
                };

                // Prepare data for insertion, mapping CSV column names to database column names.
                // Use null coalescing operator (?? null) to safely handle cases where a CSV column might be missing.
                $data[] = [
                    'tripping_document_id'      => $record['Tripping Document ID'] ?? null,
                    'tripping_no'               => $record['Tripping No.'] ?? null,
                    'source'                    => $record['Source'] ?? null,
                    'scada_non_scada'           => $record['Scada/Non Scada'] ?? null,
                    'ap_name'                   => $record['Ap Name'] ?? null,
                    'tripping_point'            => $record['Tripping Point'] ?? null,
                    'voltage'                   => isset($record['Voltage Level']) ? (float) $record['Voltage Level'] : null,
                    'load_loss'                 => isset($record['Load Loss']) ? (float) $record['Load Loss'] : null,
                    // Parse datetime strings into Carbon instances using the defined format.
                    'dispatch_date_time'        => $parseDate($record['Dispatch Date Time'] ?? null),
                    'arrival_date_time'         => $parseDate($record['Arrival Date Time'] ?? null),
                    'ap_response_time'          => isset($record['Ap Response Time']) ? (float) $record['Ap Response Time'] : null,
                    'state'                     => $record['State'] ?? null,
                    'station'                   => $record['Station'] ?? null,
                    'tripping_date_time'        => $parseDate($record['Tripping Date Time'] ?? null),
                    'restoration_date_time'     => $parseDate($record['Restoration Date Time'] ?? null),
                    'remarks'                   => $record['Remarks'] ?? null,
                    'failure_mode'              => $record['FAILURE MODE'] ?? null,
                    'description_damage_area'   => $record['Description (Damage Area)'] ?? null,
                    'substation_name'           => $record['SubstationLabel'] ?? null,
                    'substation_label'           => $record['Label'] ?? null,
                    'created_at'                => now(),
                    'updated_at'                => now(),
                ];

                // If the number of accumulated records reaches the chunk size,
                // insert them into the 'breakdown_records' table in a single batch query.
                if (count($data) >= $chunkSize) {
                    DB::table('breakdown_records')->insert($data);
                    $data = []; // Clear the array to free up memory for the next chunk
                }
            }

            // After the loop finishes, insert any remaining records that did not form a full chunk.
            if (!empty($data)) {
                DB::table('breakdown_records')->insert($data);
            }

            // Inform the user that the seeding process was successful
            $this->command->info('Breakdown records table seeded successfully!');

        } catch (\Exception $e) {
            // Catch any exceptions that occur during file reading or database operations.
            // This provides helpful feedback if something goes wrong.
            $this->command->error("Error seeding breakdown records: " . $e->getMessage());
            // For more detailed error info during debugging, you could also log: $e->getTraceAsString();
        }
    }
}