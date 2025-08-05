<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JamaahAllExport implements WithMultipleSheets
{
    protected $data;
    protected $filters;
    protected $jenis;

    public function __construct($data, $filters, $jenis)
    {
        $this->data = $data;
        $this->filters = $filters;
        $this->jenis = $jenis;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach (['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'] as $waktu) {
            if (!isset($this->data[$waktu])) {
                continue;
            }

            $filters = $this->filters;
            $filters['waktu'] = $waktu;

            $sheets[] = new JamaahExport($this->data[$waktu], $filters, $this->jenis);
        }

        return $sheets;
    }
}
