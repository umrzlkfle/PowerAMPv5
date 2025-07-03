<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;
use App\Models\Cable;
use App\Models\BreakdownRecord;
use Maatwebsite\Excel\Facades\Excel; // Ensure Maatwebsite\Excel is installed and aliased
use App\Exports\TableExport; // Assuming you have this custom export class

class Report extends Component
{
    public $format = 'xlsx'; // Default export format
    public $counts = []; // To store counts of records for display

    // Lifecycle hook: runs once when the component is mounted
    public function mount()
    {
        // Populate counts for each table to display on the page
        $this->counts = [
            'substations' => Substation::count(),
            'cables' => Cable::count(),
            'breakdown_records' => BreakdownRecord::count(),
        ];
    }

    /**
     * Handles the download of data for a specified table.
     *
     * @param string $tableName The name of the table to export.
     */
    public function downloadTable($tableName)
    {
        try {
            $data = [];
            // Generate a file name based on the table name and current timestamp
            $fileName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $tableName)) . '_' . now()->format('Ymd_His');
            
            // Fetch data based on the requested table name
            switch ($tableName) {
                case 'substations':
                    // Fetch all substations and convert them to an array of arrays
                    // Using map->toArray() ensures a consistent structure for the exporter
                    $data = Substation::all()->map(function($item) {
                        return $item->toArray();
                    })->toArray();
                    break;
                case 'cables':
                    // Fetch all cables and convert them to an array of arrays
                    $data = Cable::all()->map(function($item) {
                        return $item->toArray();
                    })->toArray();
                    break;
                case 'breakdown_records':
                    // Fetch all breakdown records and convert them to an array of arrays
                    $data = BreakdownRecord::all()->map(function($item) {
                        return $item->toArray();
                    })->toArray();
                    break;
                default:
                    // If an unknown table name is requested, dispatch an error message
                    $this->dispatch('error', message: 'Invalid table name specified for export.');
                    return null;
            }

            // Clean data: Convert any arrays/objects within the data to JSON strings
            // This prevents issues with nested data structures during CSV/XLSX export
            $cleanData = array_map(function($row) {
                return array_map(function($value) {
                    if (is_array($value) || is_object($value)) {
                        return json_encode($value); // Convert complex types to JSON string
                    }
                    return $value === null ? '' : $value; // Replace nulls with empty strings
                }, $row);
            }, $data);

            // Use Maatwebsite\Excel to download the data
            // TableExport is a custom export class (see instructions below)
            return Excel::download(
                new TableExport($cleanData, ucwords(str_replace('_', ' ', $tableName))),
                $fileName . '.' . $this->format
            );

        } catch (\Exception $e) {
            // Catch any exceptions during the export process and dispatch an error message
            $this->dispatch('error', message: 'Error generating report: ' . $e->getMessage());
            return null;
        }
    }

    // Render the Livewire component view
    public function render()
    {
        return view('livewire.report', [
            'counts' => $this->counts, // Pass the record counts to the view
        ]);
    }
}

