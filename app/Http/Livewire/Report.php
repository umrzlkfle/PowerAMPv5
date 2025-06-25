<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;
use App\Models\Cable;
use App\Models\Asset;
use App\Models\BreakdownRecord;
use App\Models\MaintenanceRecord;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TableExport;

class Report extends Component
{
    public $format = 'xlsx';
    public $counts = [];

    public function mount()
    {
        $this->counts = [
            'substations' => Substation::count(),
            'cables' => Cable::count(),
            'assets' => Asset::count(),
            'breakdown_record' => BreakdownRecord::count(),
            'maintenance_record' => MaintenanceRecord::count(),
        ];
    }

public function downloadTable($tableName)
{
    try {
        $data = [];
        $fileName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $tableName)) . '_' . now()->format('Ymd_His');

        switch ($tableName) {
            case 'substations':
                $data = Substation::all()->map(function($item) {
                    return $item->toArray();
                })->toArray();
                break;
            case 'cables':
                $data = Cable::all()->map(function($item) {
                    return $item->toArray();
                })->toArray();
                break;
            case 'assets':
                $data = Asset::all()->map(function($item) {
                    return $item->toArray();
                })->toArray();
                break;
            case 'breakdown_record':
                $data = BreakdownRecord::all()->map(function($item) {
                    return $item->toArray();
                })->toArray();
                break;
            case 'maintenance_record':
                $data = MaintenanceRecord::all()->map(function($item) {
                    return $item->toArray();
                })->toArray();
                break;
        }

        // Ensure data is properly formatted
        $cleanData = array_map(function($row) {
            return array_map(function($value) {
                if (is_array($value) || is_object($value)) {
                    return json_encode($value);
                }
                return $value === null ? '' : $value;
            }, $row);
        }, $data);

        return Excel::download(
            new TableExport($cleanData, ucwords(str_replace('_', ' ', $tableName))),
            $fileName . '.' . $this->format
        );

    } catch (\Exception $e) {
        $this->dispatch('error', message: 'Error generating report: ' . $e->getMessage());
        return null;
    }
}

    public function render()
    {
        return view('livewire.report', [
            'counts' => $this->counts
        ]);
    }
}