<?php

namespace App\Services;

use App\Models\DataKitabSantris;
use App\Models\DataKitabSantriwatis;
use App\Models\KelompokKitabSantris;
use App\Models\KelompokKitabSantriwatis;
use App\Models\KitabSantris;
use App\Models\KitabSantriwatis;
use App\Models\PresensiKitabSantris;
use App\Models\PresensiKitabSantriwatis;
use App\Models\Santris;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Kitab
{


    public function generateKitab($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);
        $kelompok = $filters['kelompok'];

        if (Str::startsWith($kelompok, 'santri-')) {
            $id = Str::after($kelompok, 'santri-');

            $nameKelompok = KitabSantris::where('id_kitab_santri', $id)->first();

            // Ambil data kegiatan (data_kitab_santris) berdasarkan kitab dan tanggal
            $kelompokData = DataKitabSantris::where('id_kitab_santri', $id)
                ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
                ->orderBy('tanggal')
                ->get();


            $dates = $kelompokData->pluck('tanggal')->unique()->map(function ($date) {
                return Carbon::parse($date);
            })->values();

            // Ambil santri yang tergabung dalam kelompok kitab tersebut
            $santris = KelompokKitabSantris::with('santri')
                ->where('id_kitab_santri', $id)
                ->get()
                ->map(function ($item) {
                    return $item->santri;
                })
                ->filter() // pastikan santri tidak null
                ->sortBy('nis')
                ->values();

            // Ambil semua presensi untuk kitab ini dalam rentang waktu
            $dataKitabIds = $kelompokData->pluck('id_data_kitab_santri');

            $presensiData = PresensiKitabSantris::with(['dataKitabSantri', 'santri'])
                ->whereIn('id_data_kitab_santri', $dataKitabIds)
                ->get()
                ->groupBy(['id_santri', 'dataKitabSantri.tanggal']);


            // Bangun array hasil
            $result = [];
            foreach ($santris as $santri) {
                $santriData = [
                    'nis' => $santri->nis,
                    'nama' => $santri->name,
                    'presensi' => [],
                    'hadir' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                    'alpha' => 0
                ];

                foreach ($dates as $date) {
                    $dateStr = $date->format('Y-m-d');
                    $status = 'alpha'; // default

                    if (isset($presensiData[$santri->id_santri][$dateStr])) {
                        $status = $presensiData[$santri->id_santri][$dateStr]->first()->status ?? 'alpha';
                    }

                    $santriData['presensi'][$dateStr] = $status;

                    // Hitung total
                    switch ($status) {
                        case 'hadir':
                            $santriData['hadir']++;
                            break;
                        case 'sakit':
                            $santriData['sakit']++;
                            break;
                        case 'izin':
                            $santriData['izin']++;
                            break;
                        case 'alpha':
                            $santriData['alpha']++;
                            break;
                    }
                }

                $result[] = $santriData;
            }

            return [
                'santris' => $result,
                'title' => 'Santri',
                'name' => $nameKelompok->name,
                'dates' => $dates,
                'periode' => $tanggalMulai->format('Y-m-d') . ' - ' . $tanggalSelesai->format('Y-m-d'),
                'total_hadir' => collect($result)->sum('hadir'),
                'total_sakit' => collect($result)->sum('sakit'),
                'total_izin' => collect($result)->sum('izin'),
                'total_alpha' => collect($result)->sum('alpha'),
            ];
        } else {
            $id = Str::after($kelompok, 'santriwati-');
            $nameKelompok = KitabSantriwatis::where('id_kitab_santriwati', $id)->first();

            // Ambil data kegiatan (data_kitab_santriwatis) berdasarkan kitab dan tanggal
            $kelompokData = DataKitabSantriwatis::where('id_kitab_santriwati', $id)
                ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
                ->orderBy('tanggal')
                ->get();

            $dates = $kelompokData->pluck('tanggal')->unique()->map(function ($date) {
                return Carbon::parse($date);
            })->values();

            // Ambil santriwati yang tergabung dalam kelompok kitab tersebut
            $santriwatis = KelompokKitabSantriwatis::with('santriwati')
                ->where('id_kitab_santriwati', $id)
                ->get()
                ->map(function ($item) {
                    return $item->santriwati;
                })
                ->filter() // pastikan santriwati tidak null
                ->sortBy('nis')
                ->values();

            // Ambil semua presensi untuk kitab ini dalam rentang waktu
            $dataKitabIds = $kelompokData->pluck('id_data_kitab_santriwati');

            $presensiData = PresensiKitabSantriwatis::with(['dataKitabSantriwati', 'santriwati'])
                ->whereIn('id_data_kitab_santriwati', $dataKitabIds)
                ->get()
                ->groupBy(['id_santriwati', 'dataKitabSantriwati.tanggal']);


            // Bangun array hasil
            $result = [];
            foreach ($santriwatis as $santriwati) {
                $santriwatiData = [
                    'nis' => $santriwati->nis,
                    'nama' => $santriwati->name,
                    'presensi' => [],
                    'hadir' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                    'alpha' => 0
                ];

                foreach ($dates as $date) {
                    $dateStr = $date->format('Y-m-d');
                    $status = 'alpha'; // default

                    if (isset($presensiData[$santriwati->id_santriwati][$dateStr])) {
                        $status = $presensiData[$santriwati->id_santriwati][$dateStr]->first()->status ?? 'alpha';
                    }

                    $santriwatiData['presensi'][$dateStr] = $status;

                    // Hitung total
                    switch ($status) {
                        case 'hadir':
                            $santriwatiData['hadir']++;
                            break;
                        case 'sakit':
                            $santriwatiData['sakit']++;
                            break;
                        case 'izin':
                            $santriwatiData['izin']++;
                            break;
                        case 'alpha':
                            $santriwatiData['alpha']++;
                            break;
                    }
                }

                $result[] = $santriwatiData;
            }

            return [
                'santriwatis' => $result,
                'title' => 'Santriwati',
                'name' => $nameKelompok->name,
                'dates' => $dates,
                'periode' => $tanggalMulai->format('Y-m-d') . ' - ' . $tanggalSelesai->format('Y-m-d'),
                'total_hadir' => collect($result)->sum('hadir'),
                'total_sakit' => collect($result)->sum('sakit'),
                'total_izin' => collect($result)->sum('izin'),
                'total_alpha' => collect($result)->sum('alpha'),
            ];
        }
    }
}
