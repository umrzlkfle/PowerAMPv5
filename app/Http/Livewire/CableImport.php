<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Cable;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

class CableImport extends Component
{
    use WithFileUploads, WithPagination;

    public $csv_cablefile;
    public $uploadedRows = [];
    public $perPage = 10;
    public $headers = [];

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'csv_cablefile' => 'required|file|mimes:csv,txt|max:10240',
    ];

    public function mount()
    {
        // No explicit mount logic needed
    }

    public function updatedCsvCablefile()
    {
        $this->resetPage('paginatedRows');
    }

    private function valueOrNull($value)
    {
        return (is_null($value) || (is_string($value) && trim($value) === '') || $value === false) ? null : $value;
    }

    public function import()
    {
        $this->validate();

        $path = $this->csv_cablefile->getRealPath();

        DB::beginTransaction();

        try {
            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0);
            $this->headers = $csv->getHeader();

            $importedData = [];

            foreach ($csv->getRecords() as $record) {
                $circId = $this->valueOrNull($record['Circ_id'] ?? null);
                $status = $this->valueOrNull($record['Status'] ?? null);

                if (is_null($circId) || is_null($status)) {
                    Log::warning('Skipping row due to missing Circ_ID or Status', ['record' => $record]);
                    continue;
                }

                $dataToUpdate = [
                    'status'               => $status,
                    'phasing'              => $this->valueOrNull($record['Phasing'] ?? null),
                    'voltage'              => $this->valueOrNull($record['Voltage'] ?? null),
                    'class'                => $this->valueOrNull($record['Class'] ?? null),
                    'owner_type'           => $this->valueOrNull($record['Owner_Type'] ?? null),
                    'owner_name'           => $this->valueOrNull($record['Owner_Name'] ?? null),
                    'from_info'            => $this->valueOrNull($record['From_Info'] ?? null),
                    'to_info'              => $this->valueOrNull($record['To_Info'] ?? null),
                    'label'                => $this->valueOrNull($record['Label'] ?? null),
                    'op_area'     => $this->valueOrNull($record['Op_Area'] ?? null),
                    'SubstationLabel'     => $this->valueOrNull($record['SubstationLabel'] ?? null),
                    'FromToName'        => $this->valueOrNull($record['FromToName'] ?? null),
                    'FromLabel'          => $this->valueOrNull($record['FromLabel'] ?? null),
                    'ToLabel'            => $this->valueOrNull($record['ToLabel'] ?? null),
                ];

                Cable::updateOrCreate(
                    ['circ_id' => $circId],
                    $dataToUpdate
                );

                $importedData[] = $record;
            }

            DB::commit();
            $this->uploadedRows = $importedData;
            $this->dispatch('import-success');
            $this->csv_cablefile = null;

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Import failed: ' . $e->getMessage());
            Log::error('CSV Import Error: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile(), [
                'exception' => $e,
                'csv_cablefile' => $this->csv_cablefile ? $this->csv_cablefile->getClientOriginalName() : 'N/A',
            ]);
        }
    }

    public function getPaginatedRowsProperty()
    {
        $page = $this->page ?? 1;
        $offset = ($page - 1) * $this->perPage;

        $items = array_slice($this->uploadedRows, $offset, $this->perPage);

        return new LengthAwarePaginator($items, count($this->uploadedRows), $this->perPage, $page);
    }

    public function getExistingCablesProperty()
    {
        return Cable::orderBy('circ_id')
                    ->paginate($this->perPage, ['*'], 'existingPage');
    }

    public function render()
    {
        return view('livewire.cable-import', [
        ]);
    }
}