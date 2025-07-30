<?php

namespace App\Services;

use App\Models\BandonganSantri;
use App\Models\BandonganSantriwati;
use App\Models\PresensiBandonganSantri;
use App\Models\PresensiBandonganSantriwati;
use App\Models\Santris;
use App\Models\Santriwatis;
use Carbon\Carbon;

class Bandongan
{
    public function generateBandonganSantri($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);

        // Get bandongan santris for the selected waktu and date range
        $bandonganData = BandonganSantri::whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
            ->orderBy('tanggal')
            ->get();

        // Get only dates that have bandongan data
        $dates = $bandonganData->pluck('tanggal')->unique()->map(function ($date) {
            return Carbon::parse($date);
        })->values();


        // Get santris with optional filter

        $santris = Santris::where('status', 'aktif')->orderBy('nis')->get();

        // Get presensi data
        $presensiData = PresensiBandonganSantri::with(['bandonganSantri', 'santri'])
            ->whereHas('bandonganSantri', function ($q) use ($filters) {
                $q->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
            })
            ->get()
            ->groupBy(['id_santri', 'bandonganSantri.tanggal']);

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

            'total_hadir' => collect($result)->sum('hadir')  ?? null,
            'total_sakit' => collect($result)->sum('sakit') ?? null,
            'total_izin' => collect($result)->sum('izin') ?? null,
            'total_alpha' => collect($result)->sum('alpha' ?? null)
        ];
    }
    public function generateBandonganSantriwati($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);

        // Get bandongan santris for the selected waktu and date range
        $bandonganData = BandonganSantriwati::whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
            ->orderBy('tanggal')
            ->get();

        // Get only dates that have bandongan data
        $dates = $bandonganData->pluck('tanggal')->unique()->map(function ($date) {
            return Carbon::parse($date);
        })->values();


        // Get santriwatis with optional filter

        $santriwatis = Santriwatis::where('status', 'aktif')->orderBy('nis')->get();

        // Get presensi data
        $presensiData = PresensiBandonganSantriwati::with(['bandonganSantriwati', 'santriwati'])
            ->whereHas('bandonganSantriwati', function ($q) use ($filters) {
                $q->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
            })
            ->get()
            ->groupBy(['id_santriwati', 'bandonganSantriwati.tanggal']);

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

            'total_hadir' => collect($result)->sum('hadir')  ?? null,
            'total_sakit' => collect($result)->sum('sakit') ?? null,
            'total_izin' => collect($result)->sum('izin') ?? null,
            'total_alpha' => collect($result)->sum('alpha' ?? null)
        ];
    }
}
