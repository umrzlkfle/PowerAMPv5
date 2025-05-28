<?php

// app/Http/Livewire/CsvProcessor.php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Substation;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;

class CsvProcessor extends Component
{
    use WithFileUploads;

    public $csvFile;
    public $processing = false;
    public $message;
    public $error;

    protected $rules = [
        'csvFile' => 'required|file|mimes:csv,txt|max:10240'
    ];

    public function processCsv()
    {
        $this->validate();
        $this->processing = true;
        $this->resetMessages();

        try {
            // Store uploaded file
            $originalName = $this->csvFile->getClientOriginalName();
            $originalPath = $this->csvFile->storeAs('temp', $originalName);
            $fullOriginalPath = storage_path('app/' . $originalPath);

            // Generate processed file name
            $processedFileName = 'processed_' . time() . '_' . $originalName;
            $processedPath = public_path('processed_csv/' . $processedFileName);

            // Execute Python script
            $process = new Process([
                'python3',
                base_path('scripts/cleaning_MVUG.py'),
                $fullOriginalPath,
                $processedPath
            ]);
            
            $process->setTimeout(120);
            $process->mustRun();

            // Verify output
            if (!file_exists($processedPath)) {
                throw new \Exception('Python script did not generate output file');
            }

            $this->importProcessedCsv($processedPath, $processedFileName);

            $this->message = "Successfully processed {$originalName}. " . $process->getOutput();

        } catch (\Exception $e) {
            $this->error = "Processing failed: " . $e->getMessage();
            Storage::delete([$originalPath, $processedPath ?? '']);
        }

        $this->processing = false;
    }

    private function importProcessedCsv($path, $fileName)
    {
        $file = fopen($path, 'r');
        $headers = fgetcsv($file);
        
        $requiredHeaders = ['Id', 'Circ_id', 'From_Info', 'To_Info', 'Voltage', 'Circ_label'];
        if (count(array_intersect($requiredHeaders, $headers)) != count($requiredHeaders)) {
            throw new \Exception('Processed CSV missing required headers');
        }

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);
            
            Substation::updateOrCreate(
                ['original_id' => $data['Id']],
                [
                    'circ_id' => $data['Circ_id'],
                    'circuit_id' => $data['Circuit_id'] ?? null,
                    'status' => $data['Status'] ?? null,
                    'phasing' => $data['Phasing'] ?? null,
                    'voltage' => $data['Voltage'] ?? null,
                    'from_info' => $data['From_Info'],
                    'to_info' => $data['To_Info'],
                    'circ_label' => $data['Circ_label'],
                    'processed_file_path' => 'processed_csv/' . $fileName
                ]
            );
        }

        fclose($file);
    }


    public function render()
    {
        return view('livewire.csvprocessor');
    }

    private function resetMessages()
    {
        $this->message = null;
        $this->error = null;
    }
}
