<?php

namespace App\Services;

use App\Models\AlquranSantris;
use App\Models\AlquranSantriwatis;
use App\Models\DataAlquranSantris;
use App\Models\DataAlquranSantriwatis;
use App\Models\KelompokAlquranSantris;
use App\Models\KelompokAlquranSantriwatis;
use App\Models\PresensiAlquranSantris;
use App\Models\PresensiAlquranSantriwatis;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Alquran
{
    public function generateAlquran($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);
        $kelompok = $filters['kelompok'];

        if (Str::startsWith($kelompok, 'santri-')) {
            $id = Str::after($kelompok, 'santri-');

            $nameKelompok = AlquranSantris::where('id_alquran_santri', $id)->first();

            // dd($kelompok);
            // Ambil data kegiatan (data_alquran_santris) berdasarkan alquran dan tanggal
            $kelompokData = DataAlquranSantris::where('id_alquran_santri', $id)
                ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
                ->orderBy('tanggal')
                ->get();


            $dates = $kelompokData->pluck('tanggal')->unique()->map(function ($date) {
                return Carbon::parse($date);
            })->values();

            // Ambil santri yang tergabung dalam kelompok alquran tersebut
            $santris = KelompokAlquranSantris::with('santri')
                ->where('id_alquran_santri', $id)
                ->get()
                ->map(function ($item) {
                    return $item->santri;
                })
                ->filter() // pastikan santri tidak null
                ->sortBy('nis')
                ->values();

            // Ambil semua presensi untuk alquran ini dalam rentang waktu
            $dataAlquranIds = $kelompokData->pluck('id_data_alquran_santri');

            $presensiData = PresensiAlquranSantris::with(['dataAlquranSantri', 'santri'])
                ->whereIn('id_data_alquran_santri', $dataAlquranIds)
                ->get()
                ->groupBy(['id_santri', 'dataAlquranSantri.tanggal']);


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
            $nameKelompok = AlquranSantriwatis::where('id_alquran_santriwati', $id)->first();

            // Ambil data kegiatan (data_alquran_santriwatis) berdasarkan alquran dan tanggal
            $kelompokData = DataAlquranSantriwatis::where('id_alquran_santriwati', $id)
                ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
                ->orderBy('tanggal')
                ->get();

            $dates = $kelompokData->pluck('tanggal')->unique()->map(function ($date) {
                return Carbon::parse($date);
            })->values();

            // Ambil santriwati yang tergabung dalam kelompok alquran tersebut
            $santriwatis = KelompokAlquranSantriwatis::with('santriwati')
                ->where('id_alquran_santriwati', $id)
                ->get()
                ->map(function ($item) {
                    return $item->santriwati;
                })
                ->filter() // pastikan santriwati tidak null
                ->sortBy('nis')
                ->values();

            // Ambil semua presensi untuk alquran ini dalam rentang waktu
            $dataalquranIds = $kelompokData->pluck('id_data_alquran_santriwati');

            $presensiData = PresensiAlquranSantriwatis::with(['dataAlquranSantriwati', 'santriwati'])
                ->whereIn('id_data_alquran_santriwati', $dataalquranIds)
                ->get()
                ->groupBy(['id_santriwati', 'dataAlquranSantriwati.tanggal']);


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
