<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BandonganExport implements FromView, WithStyles
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

    public function styles(Worksheet $sheet)
    {
        $jumlahBaris = count(
            $this->jenis === 'santri' ? $this->data['santris'] : $this->data['santriwatis']
        );

        $barisAwal = 5;
        $barisAkhir = $barisAwal + $jumlahBaris;

        // Kolom: No, Nis, Nama, H, S, I, A
        $kolomAkhir = 'G'; // 7 kolom

        $barisTotal = $barisAkhir + 2;
        $barisKeterangan = $barisTotal + 1;

        return [
            // Border untuk tabel utama
            "A{$barisAwal}:{$kolomAkhir}{$barisAkhir}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],

            // Border untuk tabel total
            "A{$barisTotal}:D{$barisTotal}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
            "A" . ($barisTotal + 1) . ":D" . ($barisTotal + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],

            // Border untuk keterangan
            "A{$barisKeterangan}:D" . ($barisKeterangan + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }

    public function view(): View
    {
        $data = [
            'data' => $this->data,
            'filters' => $this->filters,
        ];

        if ($this->jenis === 'santri') {
            return view('exports.bandongan.bandongan-santri', $data);
        } else {
            return view('exports.bandongan.bandongan-santriwati', $data);
        }
    }
}
