<?php

namespace App\Http\Controllers;

use App\Models\JamaahSantris;
use App\Models\PresensiJamaahSantris;
use App\Models\Santris;
use Illuminate\Http\Request;

class JamaahSantri extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Jamaah Santri',
            'page' => 'Jamaah Santri',
            'title' => 'Data Jamaah Santri',
            // Assuming you have a model to fetch data
            'jamaahs' => JamaahSantris::with('presensiJamaahSantris')->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('pembina.jamaah.santri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Jamaah Santri',
            'page' => 'Jamaah Santri',
            'title' => 'Tambah Data Jamaah Santri',
            'santris' => Santris::where('status', 'aktif')->orderBy('nis', 'asc')->get()
        ];
        return view('pembina.jamaah.santri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
        ]);

        $jamaah = JamaahSantris::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        foreach ($request->id_santri as $index => $idSantri) {
            PresensiJamaahSantris::create([
                'id_jamaah_santri' => $jamaah->id_jamaah_santri,
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santri-jamaah')->with('success', 'Data Jamaah Santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jamaah = JamaahSantris::with(['presensiJamaahSantris.santri'])->findOrFail($id);

        $data = [
            'selected' => 'Jamaah Santri',
            'page' => 'Jamaah Santri',
            'title' => 'Detail Jamaah Santri',
            'jamaah' => $jamaah,
        ];


        return view('pembina.jamaah.santri.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jamaah = JamaahSantris::with(['presensiJamaahSantris.santri'])->findOrFail($id);

        $data = [
            'selected' => 'Jamaah Santri',
            'page' => 'Jamaah Santri',
            'title' => 'Detail Jamaah Santri',
            'jamaah' => $jamaah,
        ];


        return view('pembina.jamaah.santri.detail', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
        ]);

        $jamaah = JamaahSantris::findOrFail($id);
        $jamaah->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        foreach ($request->id_santri as $index => $idSantri) {
            PresensiJamaahSantris::updateOrCreate(
                ['id_jamaah_santri' => $jamaah->id_jamaah_santri, 'id_santri' => $idSantri],
                [
                    'status' => $request->status[$index],
                    'catatan' => $request->catatan[$index] ?? null,
                ]
            );
        }

        return redirect()->route('pembina.santri-jamaah')->with('success', 'Data Jamaah Santri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
