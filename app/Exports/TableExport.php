<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class TableExport implements FromArray, WithHeadings, WithTitle, WithColumnFormatting
{
    protected $data;
    protected $title;

    public function __construct(array $data, string $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function array(): array
    {
        // Clean data by ensuring all values are strings and properly formatted
        return array_map(function($row) {
            return array_map(function($value) {
                if (is_array($value) || is_object($value)) {
                    return json_encode($value);
                }
                if ($value === null) {
                    return '';
                }
                return (string) $value;
            }, $row);
        }, $this->data);
    }

    public function headings(): array
    {
        if (empty($this->data)) {
            return [];
        }

        // Clean headings by removing special characters and ensuring valid string format
        return array_map(function($header) {
            // Remove any characters that might cause issues in Excel
            $header = preg_replace('/[^a-zA-Z0-9_]/', '_', $header);
            // Ensure the header isn't empty
            return !empty($header) ? $header : 'Column';
        }, array_keys($this->data[0]));
    }

    public function title(): string
    {
        // Clean the sheet title
        $title = preg_replace('/[^a-zA-Z0-9 ]/', '', $this->title);
        return substr($title, 0, 31); // Excel sheet title limit
    }

    public function columnFormats(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $formats = [];
        foreach ($this->data[0] as $key => $value) {
            if (is_numeric($value) && strlen($value) < 15) {
                $formats[$key] = NumberFormat::FORMAT_NUMBER;
            } elseif (strtotime($value)) {
                $formats[$key] = NumberFormat::FORMAT_DATE_DATETIME;
            }
        }

        return $formats;
    }
}