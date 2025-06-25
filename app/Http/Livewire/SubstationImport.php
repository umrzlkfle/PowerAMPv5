<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Substation; // Ensure your Substation model is imported
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

class SubstationImport extends Component
{
    use WithFileUploads, WithPagination;

    public $csv_file;
    public $uploadedRows = [];
    public $perPage = 10;
    public $headers = [];

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'csv_file' => 'required|file|mimes:csv,txt|max:10240',
    ];

    /**
     * Called when the component is initialized.
     */
    public function mount()
    {
        // No explicit mount logic for existingSubstations needed due to computed property approach.
    }

    /**
     * Called when a new CSV file is selected.
     * Resets pagination to the first page for the uploaded rows preview.
     */
    public function updatedCsvFile()
    {
        $this->resetPage('paginatedRows'); // Specify which pagination to reset if there are multiple.
    }

    /**
     * Helper function to convert empty strings to null.
     * @param mixed $value
     * @return mixed|null
     */
    private function valueOrNull($value)
    {
        // Check for truly empty values (null or empty string)
        // The `$value !== '0'` check is important for numeric fields
        // where '0' should be treated as a valid value, not an empty one.
        return (is_null($value) || (is_string($value) && trim($value) === '') || $value === false) ? null : $value;
    }


    /**
     * Handles the CSV file import process.
     * Validates the file, reads its content using League\Csv,
     * and stores/updates records in the database.
     */
    public function import()
    {
        // Validate the uploaded file against defined rules
        $this->validate();

        // Get the real path of the uploaded temporary file
        $path = $this->csv_file->getRealPath();

        // Start a database transaction for atomicity
        DB::beginTransaction();

        try {
            // Create a League\Csv Reader instance from the file path
            $csv = Reader::createFromPath($path, 'r');
            // Set the first row as the header, making records accessible as associative arrays
            $csv->setHeaderOffset(0);

            // Get and store the headers for displaying in the preview table
            $this->headers = $csv->getHeader();

            $importedData = [];

            // Iterate over each record in the CSV file
            // Each $record will be an associative array where keys are the CSV headers
            foreach ($csv->getRecords() as $record) {
                // Access data using the exact column names from your CSV header (case-sensitive)
                // 'Id' and 'Name' are required and checked explicitly.
                $substationId = $this->valueOrNull($record['Id'] ?? null);
                $name = $this->valueOrNull($record['Name'] ?? null);

                // Skip this row if required fields are missing after conversion to NULL
                if (is_null($substationId) || is_null($name)) {
                    Log::warning('Skipping row due to missing Id or Name', ['record' => $record]);
                    continue;
                }

                // Prepare data for updateOrCreate, applying valueOrNull to all relevant fields
                $dataToUpdate = [
                    // Ensure these match your database column names and are processed for NULLs
                    'name'               => $name, // Already processed above
                    'status'             => $this->valueOrNull($record['Status'] ?? null),
                    'owner_type'         => $this->valueOrNull($record['Owner_Type'] ?? null),
                    'owner_name'         => $this->valueOrNull($record['Owner_Name'] ?? null),
                    'design'             => $this->valueOrNull($record['Design'] ?? null),
                    'voltage'            => $this->valueOrNull($record['Voltage'] ?? null),
                    'label'              => $this->valueOrNull($record['Label'] ?? null),
                    // Ensure CSV headers 'FL' and 'Op_Area' map correctly to database columns
                    'functional_location' => $this->valueOrNull($record['FL'] ?? null),
                    'operational_area'   => $this->valueOrNull($record['Op_Area'] ?? null),
                    'category'           => $this->valueOrNull($record['Category'] ?? null),
                    'status_act'         => $this->valueOrNull($record['Status_act'] ?? null), // Assuming 'Status_act' in CSV
                    // Latitude and Longitude should be converted to float/decimal or null
                    'latitude'           => $this->valueOrNull($record['Latitude'] ?? null),
                    'longitude'          => $this->valueOrNull($record['Longitude'] ?? null),
                ];

                // For latitude and longitude, ensure they are cast to float if not null
                if (!is_null($dataToUpdate['latitude'])) {
                    $dataToUpdate['latitude'] = (float) $dataToUpdate['latitude'];
                }
                if (!is_null($dataToUpdate['longitude'])) {
                    $dataToUpdate['longitude'] = (float) $dataToUpdate['longitude'];
                }

                Substation::updateOrCreate(
                    ['substation_id' => $substationId], // Key for finding existing record
                    $dataToUpdate
                );

                // Add the processed record to the uploadedRows property for display
                $importedData[] = $record;
            }

            // Commit the transaction if all records were processed successfully
            DB::commit();

            // Set the uploadedRows property to display the imported data
            $this->uploadedRows = $importedData;

            // Dispatch a browser event to show a success message (e.g., via SweetAlert2)
            $this->dispatch('import-success');

            // Clear the file input after successful import
            $this->csv_file = null;

        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();

            // Flash an error message to the session
            session()->flash('error', 'Import failed: ' . $e->getMessage());

            // Log the full exception for detailed debugging
            Log::error('CSV Import Error: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile(), [
                'exception' => $e,
                'csv_file' => $this->csv_file ? $this->csv_file->getClientOriginalName() : 'N/A',
            ]);
        }
    }

    /**
     * Computes and returns paginated rows from the uploadedData array.
     * This method is automatically called by Livewire for pagination.
     */
    public function getPaginatedRowsProperty()
    {
        $page = $this->page ?? 1;
        $offset = ($page - 1) * $this->perPage;

        $items = array_slice($this->uploadedRows, $offset, $this->perPage);

        return new LengthAwarePaginator($items, count($this->uploadedRows), $this->perPage, $page);
    }

    /**
     * Computes and returns paginated rows of existing substation data from the database.
     */
    public function getExistingSubstationsProperty()
    {
        // Retrieve all columns from the Substation model.
        return Substation::orderBy('substation_id') // Order by a suitable column
                            ->paginate($this->perPage, ['*'], 'existingPage'); // 'existingPage' is the custom page name
    }

    /**
     * Renders the Livewire component view.
     */
    public function render()
    {
        // Pass the existingSubstations data to the view directly from the computed property
        return view('livewire.substation-import', [
            'existingSubstations' => $this->getExistingSubstationsProperty(),
            'paginatedRows' => $this->getPaginatedRowsProperty(), // Ensure this is also passed
        ]);
    }
}
