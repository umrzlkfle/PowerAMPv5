<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ExcelUpload extends Component
{
    use WithFileUploads;

    public $excelFile;

    public function updatedExcelFile()
    {
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls'
        ]);
    }

    public function upload()
    {
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls'
        ]);

        $filePath = $this->excelFile->storeAs('tmp', $this->excelFile->getClientOriginalName());

        session()->flash('message', 'Excel file uploaded successfully to: ' . $filePath);
    }

    public function render()
    {
        return view('livewire.upload-sample');
    }
}

