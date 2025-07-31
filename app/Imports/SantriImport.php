<?php

namespace App\Imports;

use App\Models\Santri;
use App\Models\Santriwati;
use App\Models\Kelas;
use App\Models\Asrama;
use App\Models\Asramas;
use App\Models\Santris;
use App\Models\Santriwatis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SantriImport implements ToCollection, WithStartRow
{
    protected $kelasMap;
    protected $asramaMap;

    public function __construct()
    {
        // Ambil semua kelas dan asrama sebagai map: ['X A' => 1, ...]
        $this->kelasMap = Kelas::pluck('id_kelas', 'name')->mapWithKeys(function ($id, $name) {
            return [trim(strtoupper($name)) => $id];
        });

        $this->asramaMap = Asramas::pluck('id_asrama', 'name')->mapWithKeys(function ($id, $name) {
            return [trim(strtoupper($name)) => $id];
        });
    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $nis        = trim($row[1]);
            $name       = trim($row[2]);
            $kelasName  = strtoupper(trim($row[3]));
            $asramaName = strtoupper(trim($row[4]));
            $jk         = strtoupper(trim($row[5]));

            $id_kelas  = $this->kelasMap[$kelasName] ?? null;
            $id_asrama = $this->asramaMap[$asramaName] ?? null;

            if (!$id_kelas || !$id_asrama || !$jk) {
                continue; // Skip jika data tidak valid
            }

            $data = [
                'nis'       => $nis,
                'name'      => $name,
                'id_kelas'  => $id_kelas,
                'id_asrama' => $id_asrama,
            ];

            if ($jk === 'L') {
                Santris::updateOrCreate(['nis' => $nis], $data);
            } elseif ($jk === 'P') {
                Santriwatis::updateOrCreate(['nis' => $nis], $data);
            }
        }
    }
}
