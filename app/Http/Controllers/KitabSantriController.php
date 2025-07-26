<?php

namespace App\Http\Controllers;

use App\Models\KitabSantris;
use Illuminate\Http\Request;

class KitabSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Data Kelompok Sorogan Kitab Santri',
            // Assuming you have a model to fetch data
            'kitabs' => KitabSantris::paginate(10)->withQueryString(),
        ];
        return view('admin.kitab.santri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Tambah Kelompok Sorogan Kitab Santri',
        ];
        return view('admin.kitab.santri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Kelompok Sorogan Kitab harus diisi.',
            'name.string' => 'Nama Kelompok Sorogan Kitab harus berupa teks.',
            'name.max' => 'Nama Kelompok Sorogan Kitab tidak boleh lebih dari 255 karakter.',
        ]);
        KitabSantris::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.santri-kitab')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kitab = KitabSantris::findOrFail($id);
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Edit Nama Kelompok Sorogan Kitab',
            'kitab' => $kitab,
        ];
        return view('admin.kitab.santri.show', $data);
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
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'name.required' => 'Nama Kelompok Sorogan Kitab harus diisi.',
            'name.string' => 'Nama Kelompok Sorogan Kitab harus berupa teks.',
            'name.max' => 'Nama Kelompok Sorogan Kitab tidak boleh lebih dari 255 karakter.',
            'status.required' => 'Status harus diisi.',
        ]);
        $kitab = KitabSantris::findOrFail($id);
        $kitab->update([
            'name' => $request->name,
            'status' => $request->status ?? 'aktif',
        ]);
        return redirect()->route('admin.santri-kitab')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kitab = KitabSantris::findOrFail($id);
        $kitab->delete();
        return redirect()->route('admin.santri-kitab')->with('success', 'Data berhasil dihapus.');
    }

    public function simpanAnggota(Request $request, $id)
    {
        $santriIds = $request->input('anggota', []);
        $kelompok = KitabSantris::findOrFail($id);

        // Sync akan menghapus yang lama dan mengganti dengan yang baru
        $kelompok->santris()->sync($santriIds);

        return redirect()->route('admin.santri-kitab')->with('success', 'Anggota berhasil disimpan!');
    }


    public function anggota($id)
    {
        $kelompok = KitabSantris::with('santris')->findOrFail($id);
        $anggota = $kelompok->santris->map(function ($santri) {
            return [
                'id' => $santri->id_santri,
                'name' => $santri->name,
                'nis' => $santri->nis,
            ];
        });
        $data = [
            'selected' => 'Kitab Santri',
            'page' => 'Kitab Santri',
            'title' => 'Anggota Kelompok Sorogan Kitab',
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ];

        return view('admin.kitab.santri.anggota', $data);
    }
}
