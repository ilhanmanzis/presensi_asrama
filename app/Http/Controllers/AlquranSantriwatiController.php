<?php

namespace App\Http\Controllers;

use App\Models\AlquranSantriwatis;
use Illuminate\Http\Request;

class AlquranSantriwatiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Data Kelompok Sorogan Alquran Santriwati',
            // Assuming you have a model to fetch data
            'alqurans' => AlquranSantriwatis::orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('admin.alquran.santriwati.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Tambah Kelompok Sorogan Alquran Santriwati',
        ];
        return view('admin.alquran.santriwati.create', $data);
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

        AlquranSantriwatis::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.santriwati-alquran')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alquran = AlquranSantriwatis::findOrFail($id);
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Edit Nama Kelompok Sorogan Alquran',
            'alquran' => $alquran,
        ];
        return view('admin.alquran.santriwati.show', $data);
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

        $alquran = AlquranSantriwatis::findOrFail($id);
        $alquran->update([
            'name' => $request->name,
            'status' => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.santriwati-alquran')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alquran = AlquranSantriwatis::findOrFail($id);
        $alquran->delete();

        return redirect()->route('admin.santriwati-alquran')->with('success', 'Data berhasil dihapus.');
    }

    public function simpanAnggota(Request $request, $id)
    {
        $santriwatiIds = $request->input('anggota', []);
        $kelompok = AlquranSantriwatis::findOrFail($id);

        // Sync akan menghapus yang lama dan mengganti dengan yang baru
        $kelompok->santriwatis()->sync($santriwatiIds);

        return redirect()->route('admin.santriwati-alquran')->with('success', 'Anggota berhasil disimpan!');
    }


    public function anggota($id)
    {
        $kelompok = AlquranSantriwatis::with('santriwatis')->findOrFail($id);
        $anggota = $kelompok->santriwatis->map(function ($santriwati) {
            return [
                'id' => $santriwati->id_santriwati,
                'name' => $santriwati->name,
                'nis' => $santriwati->nis,
            ];
        });
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Anggota Kelompok Sorogan Alquran',
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ];

        return view('admin.alquran.santriwati.anggota', $data);
    }
}
