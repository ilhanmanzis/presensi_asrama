<?php

namespace App\Http\Controllers;

use App\Models\AlquranSantris;
use App\Models\DataAlquranSantris;
use Illuminate\Http\Request;

class PresensiAlquranSantri extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Kelompok Sorogan Alquran Santri',
            // Assuming you have a model to fetch data
            'alqurans' => AlquranSantris::where('status', 'aktif')
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('pembina.alquran.santri.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $alquran = AlquranSantris::findOrFail($id);
        $santris = $alquran->santris()->where('status', 'aktif')->get();
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Tambah Presensi Sorogan Alquran Santri',
            // Assuming you have a model to fetch data
            'alquran' => $alquran,
            'santris' => $santris,
        ];

        return view('pembina.alquran.santri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            // 'kegiatan' => 'required',
        ]);
        $alquranSantri = AlquranSantris::findOrFail($id);
        $dataAlquranSantri = $alquranSantri->dataAlquranSantris()->create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);
        foreach ($request->id_santri as $index => $idSantri) {
            $dataAlquranSantri->presensi()->create([
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }
        return redirect()->route('pembina.santri-alquran.show', ['id' => $alquranSantri->id_alquran_santri])
            ->with('success', 'Presensi Sorogan Alquran Santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataAlquranSantri = AlquranSantris::findOrFail($id);
        $alqurans = $dataAlquranSantri->dataAlquranSantris()->tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Presensi Sorogan Alquran Santri',
            // Fetch the specific Alquran santri by ID
            'alqurans' => $alqurans,
            'kelompok' => $dataAlquranSantri,
            // Assuming you have a model to fetch presensi data
        ];



        return view('pembina.alquran.santri.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $alquranId, string $id)
    {
        $dataAlquranSantri = AlquranSantris::findOrFail($alquranId);
        $alquran = $dataAlquranSantri->dataAlquranSantris()->where('id_data_Alquran_santri', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Edit Presensi Sorogan Alquran Santri',
            // Fetch the specific Alquran santri by ID
            'alquran' => $alquran,
            'kelompok' => $dataAlquranSantri,
        ];


        return view('pembina.alquran.santri.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $alquranId, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            // 'kegiatan' => 'required',
        ]);
        $dataAlquranSantri = AlquranSantris::findOrFail($alquranId);
        $alquran = $dataAlquranSantri->dataAlquranSantris()->where('id_data_Alquran_santri', $id)->firstOrFail();
        $alquran->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);

        foreach ($alquran->presensi as $presensi) {
            $presensi->delete();
        }
        foreach ($request->id_santri as $index => $idSantri) {
            $alquran->presensi()->create([
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santri-alquran.show', ['id' => $dataAlquranSantri->id_alquran_santri])
            ->with('success', 'Presensi Sorogan Alquran Santri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $alquranId, string $id)
    {
        $dataAlquranSantri = AlquranSantris::findOrFail($alquranId);
        $alquran = $dataAlquranSantri->dataAlquranSantris()->where('id_data_Alquran_santri', $id)->firstOrFail();

        $alquran->delete();
        return redirect()->route('pembina.santri-alquran.show', ['id' => $alquranId])
            ->with('success', 'Presensi Sorogan Alquran Santri berhasil dihapus.');
    }

    public function detail(string $alquranId, string $id)
    {
        $dataAlquranSantri = AlquranSantris::findOrFail($alquranId);
        $alquran = $dataAlquranSantri->dataAlquranSantris()->where('id_data_Alquran_santri', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Detail Presensi Sorogan Alquran Santri',
            // Fetch the specific Alquran santri by ID
            'alquran' => $alquran,
            'kelompok' => $dataAlquranSantri,
        ];

        return view('pembina.alquran.santri.detail', $data);
    }
}
