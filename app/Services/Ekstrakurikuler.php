<?php

namespace App\Services;

use App\Models\DataEkstrakurikulers;
use App\Models\Ekstrakurikulers;
use App\Models\KelompokEkstrakurikulerSantris;
use App\Models\KelompokEkstrakurikulerSantriwatis;
use App\Models\PresensiEkstrakurikulers;
use App\Models\Santris;
use App\Models\Santriwatis;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Ekstrakurikuler
{
    public function generateEkstrakurikuler($filters)
    {
        $tanggalMulai = Carbon::parse($filters['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($filters['tanggal_selesai']);
        $id = $filters['ekstrakurikuler'];

        $namaEkskul = Ekstrakurikulers::find($id)->name;

        // Ambil data kegiatan berdasarkan tanggal dan ekskul
        $dataEkskul = DataEkstrakurikulers::where('id_ekstrakurikuler', $id)
            ->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']])
            ->orderBy('tanggal')
            ->get();


        $dates = $dataEkskul->pluck('tanggal')->unique()->map(fn($d) => Carbon::parse($d))->values();
        $dataIds = $dataEkskul->pluck('id_data_ekstrakurikuler');

        // Ambil presensi santri & santriwati dalam periode
        $presensi = PresensiEkstrakurikulers::with(['santri', 'santriwati', 'dataEkstrakurikuler'])
            ->whereIn('id_data_ekstrakurikuler', $dataIds)
            ->get();

        $presensiSantri = $presensi->whereNotNull('id_santri')->groupBy(['id_santri', 'dataEkstrakurikuler.tanggal']);
        $presensiSantriwati = $presensi->whereNotNull('id_santriwati')->groupBy(['id_santriwati', 'dataEkstrakurikuler.tanggal']);

        // Ambil data santri
        $santris = Santris::whereIn('id_santri', $presensi->pluck('id_santri')->filter())->where('status', 'aktif')->orderBy('nis', 'asc')->get();
        $santriwatis = Santriwatis::whereIn('id_santriwati', $presensi->pluck('id_santriwati')->filter())->where('status', 'aktif')->orderBy('nis', 'asc')->get();

        $result = [];

        // === Santri ===
        foreach ($santris as $santri) {
            $data = [
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
                $status = 'alpha';

                if (isset($presensiSantri[$santri->id_santri][$dateStr])) {
                    $status = $presensiSantri[$santri->id_santri][$dateStr]->first()->status ?? 'alpha';
                }

                $data['presensi'][$dateStr] = $status;

                switch ($status) {
                    case 'hadir':
                        $data['hadir']++;
                        break;
                    case 'sakit':
                        $data['sakit']++;
                        break;
                    case 'izin':
                        $data['izin']++;
                        break;
                    case 'alpha':
                        $data['alpha']++;
                        break;
                }
            }

            $result[] = $data;
        }

        // === Santriwati ===
        foreach ($santriwatis as $santriwati) {
            $data = [
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
                $status = 'alpha';

                if (isset($presensiSantriwati[$santriwati->id_santriwati][$dateStr])) {
                    $status = $presensiSantriwati[$santriwati->id_santriwati][$dateStr]->first()->status ?? 'alpha';
                }

                $data['presensi'][$dateStr] = $status;

                switch ($status) {
                    case 'hadir':
                        $data['hadir']++;
                        break;
                    case 'sakit':
                        $data['sakit']++;
                        break;
                    case 'izin':
                        $data['izin']++;
                        break;
                    case 'alpha':
                        $data['alpha']++;
                        break;
                }
            }

            $result[] = $data;
        }
        // dd($result);

        return [
            'presensis' => $result,
            'title' => 'Laporan Presensi Ekstrakurikuler',
            'name' => $namaEkskul,
            'dates' => $dates,
            'periode' => $tanggalMulai->format('Y-m-d') . ' - ' . $tanggalSelesai->format('Y-m-d'),
            'total_hadir' => collect($result)->sum('hadir'),
            'total_sakit' => collect($result)->sum('sakit'),
            'total_izin' => collect($result)->sum('izin'),
            'total_alpha' => collect($result)->sum('alpha'),
        ];
    }
}
