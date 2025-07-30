<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JamaahExport implements FromView, WithStyles
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
    /**
     * @return \Illuminate\Support\Collection
     */

    public function styles(Worksheet $sheet)
    {
        if ($this->jenis === 'santri') {
            $jumlahTanggal = count($this->data['dates']);
            $jumlahSantri = count($this->data['santris']);

            $jumlahKolom = 3 + $jumlahTanggal + 4; // 3 = No, NIS, Nama | 4 = H, S, I, A
            $kolomAkhir = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($jumlahKolom);

            $barisAwalPresensi = 5;
            $barisAkhirPresensi = $barisAwalPresensi + $jumlahSantri + 2;

            // Baris kosong: $barisAkhirPresensi + 1
            $barisTotal = $barisAkhirPresensi + 2;
            $barisKeterangan = $barisTotal + 1;

            return [
                // Border untuk tabel utama presensi
                "A{$barisAwalPresensi}:{$kolomAkhir}{$barisAkhirPresensi}" => [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],

                // Border untuk tabel total
                "A{$barisTotal}:D{$barisTotal}" => [ // judul "Total"
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],
                "A" . ($barisTotal + 1) . ":D" . ($barisTotal + 1) => [ // nilai total H/S/I/A
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],

                // Border untuk keterangan
                "A" . ($barisKeterangan) . ":D" . ($barisKeterangan + 1) => [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],
            ];
        } else {
            $jumlahTanggal = count($this->data['dates']);
            $jumlahSantriwati = count($this->data['santriwatis']);

            $jumlahKolom = 3 + $jumlahTanggal + 4; // 3 = No, NIS, Nama | 4 = H, S, I, A
            $kolomAkhir = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($jumlahKolom);

            $barisAwalPresensi = 5;
            $barisAkhirPresensi = $barisAwalPresensi + $jumlahSantriwati + 2;

            // Baris kosong: $barisAkhirPresensi + 1
            $barisTotal = $barisAkhirPresensi + 2;
            $barisKeterangan = $barisTotal + 1;

            return [
                // Border untuk tabel utama presensi
                "A{$barisAwalPresensi}:{$kolomAkhir}{$barisAkhirPresensi}" => [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],

                // Border untuk tabel total
                "A{$barisTotal}:D{$barisTotal}" => [ // judul "Total"
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],
                "A" . ($barisTotal + 1) . ":D" . ($barisTotal + 1) => [ // nilai total H/S/I/A
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],

                // Border untuk keterangan
                "A" . ($barisKeterangan) . ":D" . ($barisKeterangan + 1) => [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ],
            ];
        }
    }


    public function view(): View
    {
        $data = [
            'data' =>  $this->data,
            'filters' =>  $this->filters,
        ];
        if ($this->jenis === 'santri') {
            return view('exports/jamaah/jamaah-santri', $data);
        } else {
            return view('exports/jamaah/jamaah-santriwati', $data);
        }
    }
}
