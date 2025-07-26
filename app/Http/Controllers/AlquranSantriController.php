<?php

namespace App\Http\Controllers;

use App\Models\AlquranSantris;
use App\Models\KelompokAlquranSantris;
use Illuminate\Http\Request;

class AlquranSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Data Kelompok Sorogan Alquran Santri',
            // Assuming you have a model to fetch data
            'alqurans' => AlquranSantris::paginate(10)->withQueryString(),
        ];
        return view('admin.alquran.santri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Tambah Kelompok Sorogan Alquran Santri',
        ];
        return view('admin.alquran.santri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Kelompok Sorogan Alquran harus diisi.',
            'name.string' => 'Nama Kelompok Sorogan Alquran harus berupa teks.',
            'name.max' => 'Nama Kelompok Sorogan Alquran tidak boleh lebih dari 255 karakter.',
        ]);

        AlquranSantris::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.santri-alquran')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alquran = AlquranSantris::findOrFail($id);
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Edit Nama Kelompok Sorogan Alquran',
            'alquran' => $alquran,
        ];
        return view('admin.alquran.santri.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:aktif,nonaktif',
        ], [
            'name.required' => 'Nama Kelompok Sorogan Alquran harus diisi.',
            'name.string' => 'Nama Kelompok Sorogan Alquran harus berupa teks.',
            'name.max' => 'Nama Kelompok Sorogan Alquran tidak boleh lebih dari 255 karakter.',
            'status.in' => 'Status harus berupa "aktif" atau "nonaktif".',
        ]);

        $alquran = AlquranSantris::findOrFail($id);
        $alquran->update([
            'name' => $request->name,
            'status' => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.santri-alquran')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alquran = AlquranSantris::findOrFail($id);
        $alquran->delete();

        return redirect()->route('admin.santri-alquran')->with('success', 'Data berhasil dihapus.');
    }

    public function simpanAnggota(Request $request, $id)
    {
        $santriIds = $request->input('anggota', []);
        $kelompok = AlquranSantris::findOrFail($id);

        // Sync akan menghapus yang lama dan mengganti dengan yang baru
        $kelompok->santris()->sync($santriIds);

        return redirect()->route('admin.santri-alquran')->with('success', 'Anggota berhasil disimpan!');
    }


    public function anggota($id)
    {
        $kelompok = AlquranSantris::with('santris')->findOrFail($id);
        $anggota = $kelompok->santris->map(function ($santri) {
            return [
                'id' => $santri->id_santri,
                'name' => $santri->name,
                'nis' => $santri->nis,
            ];
        });
        $data = [
            'selected' => 'Alquran Santri',
            'page' => 'Alquran Santri',
            'title' => 'Anggota Kelompok Sorogan Alquran',
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ];

        return view('admin.alquran.santri.anggota', $data);
    }
}
