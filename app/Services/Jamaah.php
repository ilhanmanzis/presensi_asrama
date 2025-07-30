<?php

namespace App\Services;

use App\Models\JamaahSantris;
use App\Models\JamaahSantriwatis;
use App\Models\PresensiJamaahSantris;
use App\Models\PresensiJamaahSantriwatis;
use App\Models\Santris;
use App\Models\Santriwatis;
use Carbon\Carbon;

class Jamaah
{
    public function generateJamaahSantri($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);
        $waktu = $filters['waktu'];

        // Get jamaah santris for the selected waktu and date range
        $jamaahData = JamaahSantris::where('waktu', $waktu)
            ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
            ->orderBy('tanggal')
            ->get();

        // Get only dates that have jamaah data
        $dates = $jamaahData->pluck('tanggal')->unique()->map(function ($date) {
            return Carbon::parse($date);
        })->values();


        // Get santris with optional filter

        $santris = Santris::where('status', 'aktif')->orderBy('nis')->get();

        // Get presensi data
        $presensiData = PresensiJamaahSantris::with(['jamaahSantri', 'santri'])
            ->whereHas('jamaahSantri', function ($q) use ($waktu, $filters) {
                $q->where('waktu', $waktu)
                    ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
            })
            ->get()
            ->groupBy(['id_santri', 'jamaahSantri.tanggal']);

        // Build result data
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


            if (!empty($dates)) {
                foreach ($dates as $date) {
                    $dateStr = $date->format('Y-m-d');
                    $status = 'alpha'; // Default Alpha

                    if (isset($presensiData[$santri->id_santri][$dateStr])) {
                        $presensi = $presensiData[$santri->id_santri][$dateStr]->first();
                        $status = $presensi->status;
                    }

                    $santriData['presensi'][$dateStr] = $status;

                    // Count status
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
        }

        // dd($dates);
        return [
            'santris' => $result ?? null,
            'dates' => $dates ?? null,
            'periode' => $tanggalMulai->format('Y-m-d') . ' - ' . $tanggalSelesai->format('Y-m-d') ?? null,
            'waktu' => ucfirst($waktu) ?? null,
            'total_hadir' => collect($result)->sum('hadir')  ?? null,
            'total_sakit' => collect($result)->sum('sakit') ?? null,
            'total_izin' => collect($result)->sum('izin') ?? null,
            'total_alpha' => collect($result)->sum('alpha' ?? null)
        ];
    }
    public function generateJamaahSantriwati($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);
        $waktu = $filters['waktu'];

        // Get jamaah santris for the selected waktu and date range
        $jamaahData = JamaahSantriwatis::where('waktu', $waktu)
            ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
            ->orderBy('tanggal')
            ->get();

        // Get only dates that have jamaah data
        $dates = $jamaahData->pluck('tanggal')->unique()->map(function ($date) {
            return Carbon::parse($date);
        })->values();


        // Get santriwatis with optional filter

        $santriwatis = Santriwatis::where('status', 'aktif')->orderBy('nis')->get();

        // Get presensi data
        $presensiData = PresensiJamaahSantriwatis::with(['jamaahSantriwati', 'santriwati'])
            ->whereHas('jamaahSantriwati', function ($q) use ($waktu, $filters) {
                $q->where('waktu', $waktu)
                    ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
            })
            ->get()
            ->groupBy(['id_santriwati', 'jamaahSantriwati.tanggal']);

        // Build result data
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


            if (!empty($dates)) {
                foreach ($dates as $date) {
                    $dateStr = $date->format('Y-m-d');
                    $status = 'alpha'; // Default Alpha

                    if (isset($presensiData[$santriwati->id_santriwati][$dateStr])) {
                        $presensi = $presensiData[$santriwati->id_santriwati][$dateStr]->first();
                        $status = $presensi->status;
                    }

                    $santriwatiData['presensi'][$dateStr] = $status;

                    // Count status
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
        }

        // dd($dates);
        return [
            'santriwatis' => $result ?? null,
            'dates' => $dates ?? null,
            'periode' => $tanggalMulai->format('Y-m-d') . ' - ' . $tanggalSelesai->format('Y-m-d') ?? null,
            'waktu' => ucfirst($waktu) ?? null,
            'total_hadir' => collect($result)->sum('hadir')  ?? null,
            'total_sakit' => collect($result)->sum('sakit') ?? null,
            'total_izin' => collect($result)->sum('izin') ?? null,
            'total_alpha' => collect($result)->sum('alpha' ?? null)
        ];
    }
}
