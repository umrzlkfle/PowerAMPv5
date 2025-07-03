<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TableExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $data;
    protected $title;

    public function __construct(array $data, string $title = 'Export')
    {
        $this->data = $data;
        $this->title = $title;
    }

    /**
    * @return array
    */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Get headings from the first row of data if available, otherwise return empty.
        // This assumes the first row of your $data array contains the headers.
        // If your data does NOT include headers, you'll need to define them manually here
        // or pass them into the constructor.
        if (empty($this->data)) {
            return []; // Or define default headers if known
        }
        return array_keys($this->data[0]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }
}