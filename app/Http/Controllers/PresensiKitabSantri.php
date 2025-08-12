<?php

namespace App\Http\Controllers;

use App\Models\KitabSantris;
use Illuminate\Http\Request;

class PresensiKitabSantri extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Kelompok Sorogan Kitab Santri',
            // Assuming you have a model to fetch data
            'kitabs' => KitabSantris::where('status', 'aktif')
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('pembina.kitab.santri.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $kitab = KitabSantris::findOrFail($id);
        $santris = $kitab->santris()->where('status', 'aktif')->get();
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Tambah Presensi Sorogan Kitab Santri',
            // Assuming you have a model to fetch data
            'kitab' => $kitab,
            'santris' => $santris,
        ];

        return view('pembina.kitab.santri.create', $data);
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
        $kitabSantri = KitabSantris::findOrFail($id);
        $dataKitabSantri = $kitabSantri->dataKitabSantris()->create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);
        foreach ($request->id_santri as $index => $idSantri) {
            $dataKitabSantri->presensi()->create([
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }
        return redirect()->route('pembina.santri-kitab.show', ['id' => $kitabSantri->id_kitab_santri])
            ->with('success', 'Presensi Sorogan Kitab Santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataKitabSantri = KitabSantris::findOrFail($id);
        $kitabs = $dataKitabSantri->dataKitabSantris()->tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Presensi Sorogan Kitab Santri',
            // Fetch the specific kitab santri by ID
            'kitabs' => $kitabs,
            'kelompok' => $dataKitabSantri,
            // Assuming you have a model to fetch presensi data
        ];



        return view('pembina.kitab.santri.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kitabId, string $id)
    {
        $dataKitabSantri = KitabSantris::findOrFail($kitabId);
        $kitab = $dataKitabSantri->dataKitabSantris()->where('id_data_kitab_santri', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Edit Presensi Sorogan Kitab Santri',
            // Fetch the specific kitab santri by ID
            'kitab' => $kitab,
            'kelompok' => $dataKitabSantri,
        ];


        return view('pembina.kitab.santri.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kitabId, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            // 'kegiatan' => 'required',
        ]);
        $dataKitabSantri = KitabSantris::findOrFail($kitabId);
        $kitab = $dataKitabSantri->dataKitabSantris()->where('id_data_kitab_santri', $id)->firstOrFail();
        $kitab->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);

        foreach ($kitab->presensi as $presensi) {
            $presensi->delete();
        }
        foreach ($request->id_santri as $index => $idSantri) {
            $kitab->presensi()->create([
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santri-kitab.show', ['id' => $dataKitabSantri->id_kitab_santri])
            ->with('success', 'Presensi Sorogan Kitab Santri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kitabId, string $id)
    {
        $dataKitabSantri = KitabSantris::findOrFail($kitabId);
        $kitab = $dataKitabSantri->datakitabSantris()->where('id_data_kitab_santri', $id)->firstOrFail();

        $kitab->delete();
        return redirect()->route('pembina.santri-kitab.show', ['id' => $kitabId])
            ->with('success', 'Presensi Sorogan Kitab Santri berhasil dihapus.');
    }

    public function detail(string $kitabId, string $id)
    {
        $dataKitabSantri = KitabSantris::findOrFail($kitabId);
        $kitab = $dataKitabSantri->dataKitabSantris()->where('id_data_kitab_santri', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Detail Presensi Sorogan Kitab Santri',
            // Fetch the specific kitab santri by ID
            'kitab' => $kitab,
            'kelompok' => $dataKitabSantri,
        ];

        return view('pembina.kitab.santri.detail', $data);
    }
}
