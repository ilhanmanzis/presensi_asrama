<?php

namespace App\Http\Controllers;

use App\Models\KitabSantriwatis;
use Illuminate\Http\Request;

class KitabSantriwatiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Data Kelompok Sorogan Kitab Santriwati',
            // Assuming you have a model to fetch data
            'kitabs' => KitabSantriwatis::orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('admin.kitab.santriwati.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Tambah Kelompok Sorogan Kitab Santriwati',
        ];
        return view('admin.kitab.santriwati.create', $data);
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
        KitabSantriwatis::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.santriwati-kitab')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kitab = KitabSantriwatis::findOrFail($id);
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Edit Nama Kelompok Sorogan Kitab',
            'kitab' => $kitab,
        ];

        return view('admin.kitab.santriwati.show', $data);
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
        $kitab = KitabSantriwatis::findOrFail($id);
        $kitab->update([
            'name' => $request->name,
            'status' => $request->status ?? 'aktif',
        ]);
        return redirect()->route('admin.santriwati-kitab')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kitab = KitabSantriwatis::findOrFail($id);
        $kitab->delete();
        return redirect()->route('admin.santriwati-kitab')->with('success', 'Data berhasil dihapus.');
    }

    public function simpanAnggota(Request $request, $id)
    {
        $santriwatiIds = $request->input('anggota', []);
        $kelompok = KitabSantriwatis::findOrFail($id);

        // Sync akan menghapus yang lama dan mengganti dengan yang baru
        $kelompok->santriwatis()->sync($santriwatiIds);

        return redirect()->route('admin.santriwati-kitab')->with('success', 'Anggota berhasil disimpan!');
    }


    public function anggota($id)
    {
        $kelompok = KitabSantriwatis::with('santriwatis')->findOrFail($id);
        $anggota = $kelompok->santriwatis->map(function ($santriwati) {
            return [
                'id' => $santriwati->id_santriwati,
                'name' => $santriwati->name,
                'nis' => $santriwati->nis,
            ];
        });
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Anggota Kelompok Sorogan Kitab',
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ];

        return view('admin.kitab.santriwati.anggota', $data);
    }
}
