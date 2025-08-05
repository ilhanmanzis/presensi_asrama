<?php

namespace App\Http\Controllers;

use App\Exports\AlquranExport;
use App\Exports\BandonganExport;
use App\Exports\Diterima;
use App\Exports\EkstrakurikulerExport;
use App\Exports\JamaahAllExport;
use App\Exports\JamaahExport;
use App\Exports\KitabExport;
use App\Exports\Margin;
use App\Exports\MarginAll;
use App\Exports\Pengeluaran;
use App\Exports\PengeluaranAll;
use App\Exports\Piutang;
use App\Exports\PiutangAll;
use App\Exports\PriceListExport;
use App\Exports\Retur;
use App\Exports\Transaksi;
use App\Exports\TransaksiAll;
use App\Models\AlquranSantris;
use App\Models\AlquranSantriwatis;
use App\Models\Ekstrakurikulers;
use App\Models\JamaahSantris;
use App\Models\JamaahSantriwatis;
use App\Models\Kategoris;
use App\Models\KelompokKitabSantris;
use App\Models\KelompokKitabSantriwatis;
use App\Models\KitabSantris;
use App\Models\KitabSantriwatis;
use App\Models\Pelanggans;
use App\Models\Pengeluarans;
use App\Models\PresensiJamaahSantris;
use App\Models\PresensiJamaahSantriwatis;
use App\Models\Produks;
use App\Models\Profile;
use App\Models\Returs;
use App\Models\Santris;
use App\Models\Santriwatis;
use App\Models\SuratJalanDetails;
use App\Models\TransaksiDetail;
use App\Models\Transaksis;
use App\Services\Alquran;
use App\Services\Bandongan;
use App\Services\Ekstrakurikuler;
use App\Services\Jamaah;
use App\Services\Kitab;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $waktu;
    public function __construct()
    {
        $this->waktu = now();
    }
    public function index()
    {
        $kitabsantris = KitabSantris::orderBy('created_at', 'desc')->get();
        $kitabsantriwatis = KitabSantriwatis::orderBy('created_at', 'desc')->get();
        $alquransantris = AlquranSantris::orderBy('created_at', 'desc')->get();
        $alquransantriwatis = AlquranSantriwatis::orderBy('created_at', 'desc')->get();

        // dd($kitabsantris);
        $data = [
            'selected' =>  'Export & Laporan',
            'page' => 'Export & Laporan',
            'title' => 'Export & Laporan',
            'ekstrakurikulers' => Ekstrakurikulers::all(),
            'kitabsantris' => $kitabsantris,
            'kitabsantriwatis' => $kitabsantriwatis,
            'alquransantris' => $alquransantris,
            'alquransantriwatis' => $alquransantriwatis

        ];

        return view('laporan/index', $data);
    }

    public function jamaah(Request $request, Jamaah $jamaah)
    {

        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'siswa' => 'required',
            'waktu' => 'required'
        ], [
            'mulai.required' => 'mulai tidak boleh kosong',
            'selesai.required' => 'selesai tidak boleh kosong',
            'siswa.required' => 'siswa tidak boleh kosong',
            'waktu.required' => 'waktu tidak boleh kosong',
        ]);

        $siswa = $request->siswa;
        $action = $request->input('export');
        $mulai = $request->mulai;
        $selesai = $request->selesai;
        $allWaktu = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];




        if ($siswa === 'santri') {

            if ($request->waktu === 'all') {
                $data = [];
                foreach ($allWaktu as $waktu) {
                    $filters = [
                        'tanggal_mulai' => $mulai,
                        'tanggal_selesai' => $selesai,
                        $siswa => $siswa, // santri atau santriwati
                        'waktu' => $waktu
                    ];
                    $result = $siswa === 'santri'
                        ? $jamaah->generateJamaahSantri($filters)
                        : $jamaah->generateJamaahSantriwati($filters);

                    $data[$waktu] = $result;
                }

                $filters = [
                    'tanggal_mulai' => $mulai,
                    'tanggal_selesai' => $selesai,
                    'santri' => $siswa,
                    'waktu' => 'all'
                ];

                if ($action === 'pdf') {
                    $pdf = Pdf::loadView(
                        'laporan/jamaah/jamaah-santri-semua',
                        compact('data', 'filters')
                    );
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('laporan presensi jamaah santri semua waktu ' . $mulai . '-' . $selesai . '.pdf');
                } else {
                    return Excel::download(
                        new JamaahAllExport($data, $filters, $siswa),
                        'laporan presensi jamaah santri semua waktu ' . $mulai . '-' . $selesai . '.xlsx'
                    );
                }
            }
            $filters = [
                'tanggal_mulai' => $mulai,
                'tanggal_selesai' => $selesai,
                'santri' => $siswa,
                'waktu' => $request->waktu
            ];
            $data = $jamaah->generateJamaahSantri($filters);
            if ($action === 'pdf') {
                $pdf = Pdf::loadView('laporan/jamaah/jamaah-santri', compact('data', 'filters'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('laporan presensi jamaah santri ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
            } else {
                return Excel::download(
                    new JamaahExport($data, $filters, 'santri'),
                    'laporan presensi jamaah santri ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
                );
            }
        } else {
            if ($request->waktu === 'all') {
                $data = [];
                foreach ($allWaktu as $waktu) {
                    $filters = [
                        'tanggal_mulai' => $mulai,
                        'tanggal_selesai' => $selesai,
                        $siswa => $siswa, // santri atau santriwati
                        'waktu' => $waktu
                    ];
                    $result = $jamaah->generateJamaahSantriwati($filters);

                    $data[$waktu] = $result;
                }

                $filters = [
                    'tanggal_mulai' => $mulai,
                    'tanggal_selesai' => $selesai,
                    'santriwati' => $siswa,
                    'waktu' => 'all'
                ];
                // dd($data);


                if ($action === 'pdf') {
                    $pdf = Pdf::loadView(
                        'laporan/jamaah/jamaah-santriwati-semua',
                        compact('data', 'filters')
                    );
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('laporan presensi jamaah santriwati semua waktu ' . $mulai . '-' . $selesai . '.pdf');
                } else {
                    return Excel::download(
                        new JamaahAllExport($data, $filters, $siswa),
                        'laporan presensi jamaah santriwati semua waktu ' . $mulai . '-' . $selesai . '.xlsx'
                    );
                }
            }
            $filters = [
                'tanggal_mulai' => $request->mulai,
                'tanggal_selesai' => $request->selesai,
                'santriwati' => $siswa,
                'waktu' => $request->waktu
            ];
            $data = $jamaah->generateJamaahSantriwati($filters);
            if ($action === 'pdf') {
                $pdf = Pdf::loadView('laporan/jamaah/jamaah-santriwati', compact('data', 'filters'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('laporan presensi jamaah santriwati ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
            } else {
                return Excel::download(
                    new JamaahExport($data, $filters, 'santriwati'),
                    'laporan presensi jamaah santriwati ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
                );
            }
        }
    }
    public function bandongan(Request $request, Bandongan $bandongan)
    {
        // dd($request->all());
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'siswa' => 'required',
        ], [
            'mulai.required' => 'mulai tidak boleh kosong',
            'selesai.required' => 'selesai tidak boleh kosong',
            'siswa.required' => 'siswa tidak boleh kosong',
        ]);

        $siswa = $request->siswa;
        $action = $request->input('export');
        $mulai = $request->mulai;
        $selesai = $request->selesai;

        if ($siswa === 'santri') {
            $filters = [
                'tanggal_mulai' => $mulai,
                'tanggal_selesai' => $selesai,
                'santri' => $siswa,
            ];
            $data = $bandongan->generateBandonganSantri($filters);
            if ($action === 'pdf') {
                $pdf = Pdf::loadView('laporan/bandongan/bandongan-santri', compact('data', 'filters'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('laporan presensi bandongan santri ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
            } else {
                return Excel::download(
                    new BandonganExport($data, $filters, 'santri'),
                    'laporan presensi bandongan santri ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
                );
            }
        } else {
            $filters = [
                'tanggal_mulai' => $request->mulai,
                'tanggal_selesai' => $request->selesai,
                'santriwati' => $siswa,
            ];
            $data = $bandongan->generateBandonganSantriwati($filters);
            if ($action === 'pdf') {
                $pdf = Pdf::loadView('laporan/bandongan/bandongan-santriwati', compact('data', 'filters'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('laporan presensi bandongan santriwati ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
            } else {
                return Excel::download(
                    new BandonganExport($data, $filters, 'santriwati'),
                    'laporan presensi bandongan santriwati ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
                );
            }
        }
    }

    public function kitab(Request $request, Kitab $kitab)
    {
        // dd($request->all());
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'kelompok' => 'required',
        ], [
            'mulai.required' => 'mulai tidak boleh kosong',
            'selesai.required' => 'selesai tidak boleh kosong',
            'kelompok.required' => 'kelompok tidak boleh kosong',
        ]);

        $kelompok = $request->kelompok;
        $action = $request->input('export');
        $mulai = $request->mulai;
        $selesai = $request->selesai;


        $filters = [
            'tanggal_mulai' => $mulai,
            'tanggal_selesai' => $selesai,
            'kelompok' => $kelompok,
        ];
        $data = $kitab->generateKitab($filters);
        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/kitab/kitab', compact('data', 'filters'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('laporan presensi kitab ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new KitabExport($data, $filters, $data['title']),
                'laporan presensi kitab ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }
    public function alquran(Request $request, Alquran $alquran)
    {
        // dd($request->all());
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'kelompok' => 'required',
        ], [
            'mulai.required' => 'mulai tidak boleh kosong',
            'selesai.required' => 'selesai tidak boleh kosong',
            'kelompok.required' => 'kelompok tidak boleh kosong',
        ]);

        $kelompok = $request->kelompok;
        $action = $request->input('export');
        $mulai = $request->mulai;
        $selesai = $request->selesai;


        $filters = [
            'tanggal_mulai' => $mulai,
            'tanggal_selesai' => $selesai,
            'kelompok' => $kelompok,
        ];
        // dd($request);
        $data = $alquran->generateAlquran($filters);
        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/alquran/alquran', compact('data', 'filters'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('laporan presensi alquran ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new AlquranExport($data, $filters, $data['title']),
                'laporan presensi alquran ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }
    public function ekstrakurikuler(Request $request, Ekstrakurikuler $service)
    {
        // dd($request->all());
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'ekstrakurikuler' => 'required',
        ], [
            'mulai.required' => 'mulai tidak boleh kosong',
            'selesai.required' => 'selesai tidak boleh kosong',
            'ekstrakurikuler.required' => 'ekstrakurikuler tidak boleh kosong',
        ]);

        $ekstrakurikuler = $request->ekstrakurikuler;
        $action = $request->input('export');
        $mulai = $request->mulai;
        $selesai = $request->selesai;


        $filters = [
            'tanggal_mulai' => $mulai,
            'tanggal_selesai' => $selesai,
            'ekstrakurikuler' => $ekstrakurikuler,
        ];
        // dd($request);
        $data = $service->generateEkstrakurikuler($filters);
        if ($action === 'pdf') {
            $pdf = Pdf::loadView('laporan/ekstrakurikuler/ekstrakurikuler', compact('data', 'filters'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('laporan presensi ekstrakurikuler ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.pdf');
        } else {
            return Excel::download(
                new EkstrakurikulerExport($data, $filters, $data['title']),
                'laporan presensi ekstrakurikuler ' . $mulai . '-' . $selesai . ' -- ' . $this->waktu . '.xlsx'
            );
        }
    }
}
