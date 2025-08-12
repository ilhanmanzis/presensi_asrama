<?php

namespace App\Http\Controllers;

use App\Models\DataEkstrakurikulers;
use App\Models\Ekstrakurikulers;
use App\Models\PresensiEkstrakurikulers;
use App\Models\Santris;
use App\Models\Santriwatis;
use Illuminate\Http\Request;

class PresensiEkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Data Ekstrakurikuler ',
            // Assuming you have a model to fetch data
            'ekstrakurikulers' => DataEkstrakurikulers::tanggal(request()->only(['tanggal', 'ekstrakurikuler']))->with(['presensi', 'ekstrakurikuler'])->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
            'datas' => Ekstrakurikulers::all()
        ];
        return view('pembina.ekstrakurikuler.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Tambah Data Ekstrakurikuler ',
            // Assuming you have a model to fetch active s
            'ekstrakurikulers' => Ekstrakurikulers::all(),
            'santris' => Santris::where('status', 'aktif')->orderBy('nis', 'asc')->get(),
            'santriwatis' => Santriwatis::where('status', 'aktif')->orderBy('nis', 'asc')->get()
        ];
        return view('pembina.ekstrakurikuler.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_ekstrakurikuler' => 'required',
        ]);

        $ekstrakurikuler = DataEkstrakurikulers::create([
            'tanggal' => $request->tanggal,
            'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
        ]);

        foreach ($request->id_santri as $index => $id) {
            PresensiEkstrakurikulers::create([
                'id_data_ekstrakurikuler' => $ekstrakurikuler->id_data_ekstrakurikuler,
                'id_santri' => $id ?? null,
                'id_santriwati' => null,
                'status' => $request->status_santri[$index],
                'catatan' => $request->catatan_santri[$index] ?? null,
            ]);
        }
        foreach ($request->id_santriwati as $index => $id) {
            PresensiEkstrakurikulers::create([
                'id_data_ekstrakurikuler' => $ekstrakurikuler->id_data_ekstrakurikuler,
                'id_santri' =>  null,
                'id_santriwati' => $id ?? null,
                'status' => $request->status_santriwati[$index],
                'catatan' => $request->catatan_santriwati[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.ekstrakurikuler')->with('success', 'Data Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $dataEkstrakurikuler = DataEkstrakurikulers::with(['presensi.santri', 'presensi.santriwati', 'ekstrakurikuler'])->findOrFail($id);

        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Detail Data Ekstrakurikuler ',
            'dataEkstrakurikuler' => $dataEkstrakurikuler,
            'ekstrakurikulers' => Ekstrakurikulers::all(),
        ];
        return view('pembina.ekstrakurikuler.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataEkstrakurikuler = DataEkstrakurikulers::with(['presensi.santri', 'presensi.santriwati', 'ekstrakurikuler'])->findOrFail($id);
        $presensiSantri = $dataEkstrakurikuler->presensi->filter(fn($p) => $p->santri !== null);
        $presensiSantriwati = $dataEkstrakurikuler->presensi->filter(fn($p) => $p->santriwati !== null);


        // Gabungkan: santri dulu, lalu santriwati
        $presensiTertata = $presensiSantri->concat($presensiSantriwati);
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Detail Data Ekstrakurikuler ',
            'dataEkstrakurikuler' => $dataEkstrakurikuler,
            'presensis' => $presensiTertata,
        ];
        return view('pembina.Ekstrakurikuler.detail', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_ekstrakurikuler' => 'required',
        ]);

        $ekstrakurikuler = DataEkstrakurikulers::findOrFail($id);
        $ekstrakurikuler->update([
            'tanggal' => $request->tanggal,
            'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
        ]);

        // Update presensi if needed
        foreach ($request->id_santri as $index => $id) {
            PresensiEkstrakurikulers::updateOrCreate(
                [
                    'id_data_ekstrakurikuler' => $ekstrakurikuler->id_data_ekstrakurikuler,
                    'id_santri' => $id ?? null,
                    'id_santriwati' =>  null,
                ],
                [
                    'status' => $request->status_santri[$index],
                    'catatan' => $request->catatan_santri[$index] ?? null,
                ]
            );
        }
        // Update presensi if needed
        foreach ($request->id_santriwati as $index => $id) {
            PresensiEkstrakurikulers::updateOrCreate(
                [
                    'id_data_ekstrakurikuler' => $ekstrakurikuler->id_data_ekstrakurikuler,
                    'id_santri' => null,
                    'id_santriwati' => $id ?? null,
                ],
                [
                    'status' => $request->status_santriwati[$index],
                    'catatan' => $request->catatan_santriwati[$index] ?? null,
                ]
            );
        }

        return redirect()->route('pembina.ekstrakurikuler')->with('success', 'Data Ekstrakurikuler  berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ekstrakurikuler = DataEkstrakurikulers::findOrFail($id);
        $ekstrakurikuler->delete();
        return redirect()->route('pembina.ekstrakurikuler')->with('success', 'Data Ekstrakurikuler  berhasil dihapus.');
    }
}
