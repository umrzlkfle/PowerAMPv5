<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class ReportExport implements FromArray, WithMultipleSheets, WithHeadings, WithColumnFormatting
{
    protected $data;
    protected $includeHeaders;
    protected $formatDates;

    public function __construct(array $data, bool $includeHeaders = true, bool $formatDates = true)
    {
        $this->data = $data;
        $this->includeHeaders = $includeHeaders;
        $this->formatDates = $formatDates;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->data as $sheetName => $sheetData) {
            $sheets[] = new ReportSheet($sheetName, $sheetData, $this->includeHeaders, $this->formatDates);
        }
        return $sheets;
    }

    public function headings(): array
    {
        return [];
    }

    public function columnFormats(): array
    {
        return [];
    }
}

class ReportSheet implements FromArray, WithHeadings, WithColumnFormatting
{
    protected $sheetName;
    protected $data;
    protected $includeHeaders;
    protected $formatDates;

    public function __construct(string $sheetName, array $data, bool $includeHeaders, bool $formatDates)
    {
        $this->sheetName = $sheetName;
        $this->data = $data;
        $this->includeHeaders = $includeHeaders;
        $this->formatDates = $formatDates;
    }

    public function array(): array
    {
        // Format dates if needed
            if ($this->formatDates) {
                return array_map(function($row) {
                    foreach ($row as $key => $value) {
                        // Fixed syntax: Added missing closing parenthesis
                        if (strtotime($value)) {
                            try {
                                $row[$key] = Carbon::parse($value)->format('Y-m-d H:i:s');
                            } catch (\Exception $e) {
                                // Not a date, leave as is
                            }
                        }
                    }
                    return $row;
                }, $this->data);
            }
    }

    public function headings(): array
    {
        if (!$this->includeHeaders || empty($this->data)) {
            return [];
        }

        return array_keys($this->data[0]);
    }

    public function title(): string
    {
        return substr($this->sheetName, 0, 31); // Excel sheet title limit
    }

    public function columnFormats(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $formats = [];
        foreach ($this->data[0] as $key => $value) {
            if (strtotime($value)) {
                $formats[$key] = NumberFormat::FORMAT_DATE_DATETIME;
            }
        }

        return $formats;
    }
}