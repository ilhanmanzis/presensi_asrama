<?php

namespace App\Http\Controllers;

use App\Models\JamaahSantriwatis;
use App\Models\PresensiJamaahSantriwatis;
use App\Models\Santriwatis;
use Illuminate\Http\Request;

class JamaahSantriwati extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Jamaah Santriwati',
            'page' => 'Jamaah Santriwati',
            'title' => 'Data Jamaah Santriwati',
            // Assuming you have a model to fetch data
            'jamaahs' => JamaahSantriwatis::tanggal(request()->only(['tanggal']))->with('presensiJamaahSantriwatis')->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('pembina.jamaah.santriwati.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Jamaah Santriwati',
            'page' => 'Jamaah Santriwati',
            'title' => 'Tambah Data Jamaah Santriwati',
            // Assuming you have a model to fetch active santriwatis
            'santriwatis' => Santriwatis::where('status', 'aktif')->orderBy('nis', 'asc')->get()
        ];
        return view('pembina.jamaah.santriwati.create', $data);
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

        $jamaah = JamaahSantriwatis::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        foreach ($request->id_santriwati as $index => $idSantriwati) {
            PresensiJamaahSantriwatis::create([
                'id_jamaah_santriwati' => $jamaah->id_jamaah_santriwati,
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santriwati-jamaah')->with('success', 'Data Jamaah Santriwati berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jamaah = JamaahSantriwatis::with('presensiJamaahSantriwatis.santriwati')->findOrFail($id);
        $data = [
            'selected' => 'Jamaah Santriwati',
            'page' => 'Detail Jamaah Santriwati',
            'title' => 'Detail Jamaah Santriwati',
            'jamaah' => $jamaah,
        ];
        return view('pembina.jamaah.santriwati.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jamaah = JamaahSantriwatis::with('presensiJamaahSantriwatis.santriwati')->findOrFail($id);
        $data = [
            'selected' => 'Jamaah Santriwati',
            'page' => 'Detail Jamaah Santriwati',
            'title' => 'Detail Jamaah Santriwati',
            'jamaah' => $jamaah,
        ];
        return view('pembina.jamaah.santriwati.detail', $data);
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

        $jamaah = JamaahSantriwatis::findOrFail($id);
        $jamaah->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        foreach ($request->id_santriwati as $index => $idSantriwati) {
            PresensiJamaahSantriwatis::updateOrCreate(
                ['id_jamaah_santriwati' => $jamaah->id_jamaah_santriwati, 'id_santriwati' => $idSantriwati],
                ['status' => $request->status[$index], 'catatan' => $request->catatan[$index] ?? null]
            );
        }

        return redirect()->route('pembina.santriwati-jamaah')->with('success', 'Data Jamaah Santriwati berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
