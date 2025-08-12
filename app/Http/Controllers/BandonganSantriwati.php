<?php

namespace App\Http\Controllers;

use App\Models\BandonganSantriwati as ModelsBandonganSantriwati;
use App\Models\PresensiBandonganSantriwati;
use App\Models\Santriwatis;
use Illuminate\Http\Request;

class BandonganSantriwati extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Bandongan Santriwati',
            'page' => 'Bandongan Santriwati',
            'title' => 'Data Bandongan Santriwati',
            // Assuming you have a model to fetch data
            'bandongans' => ModelsBandonganSantriwati::tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('pembina.bandongan.santriwati.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Bandongan Santriwati',
            'page' => 'Bandongan Santriwati',
            'title' => 'Tambah Data Bandongan Santriwati',
            // Assuming you have a model to fetch active santris
            'santriwatis' => Santriwatis::where('status', 'aktif')->orderBy('nis', 'asc')->get()
        ];
        return view('pembina.bandongan.santriwati.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
        ]);

        $jamaah = ModelsBandonganSantriwati::create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        foreach ($request->id_santriwati as $index => $idSantriwati) {
            PresensiBandonganSantriwati::create([
                'id_bandongan_santriwati' => $jamaah->id_bandongan_santriwati,
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
            ]);
        }

        return redirect()->route('pembina.santriwati-bandongan')->with('success', 'Data Bandongan Santriwati berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bandongan = ModelsBandonganSantriwati::with('presensi.santriwati')->findOrFail($id);
        $data = [
            'selected' => 'Bandongan Santriwati',
            'page' => 'Bandongan Santriwati',
            'title' => 'Edit Data Bandongan Santriwati',
            'bandongan' => $bandongan,
        ];
        return view('pembina.bandongan.santriwati.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bandongan = ModelsBandonganSantriwati::with('presensi.santriwati')->findOrFail($id);
        $data = [
            'selected' => 'Bandongan Santriwati',
            'page' => 'Bandongan Santriwati',
            'title' => 'Detail Data Bandongan Santriwati',
            'bandongan' => $bandongan,
        ];
        return view('pembina.bandongan.santriwati.detail', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
        ]);

        $bandongan = ModelsBandonganSantriwati::findOrFail($id);
        $bandongan->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        // Assuming you want to update the presensi as well
        foreach ($request->id_santriwati as $index => $idSantriwati) {
            PresensiBandonganSantriwati::updateOrCreate(
                ['id_bandongan_santriwati' => $bandongan->id_bandongan_santriwati, 'id_santriwati' => $idSantriwati],
                ['status' => $request->status[$index]]
            );
        }

        return redirect()->route('pembina.santriwati-bandongan')->with('success', 'Data Bandongan Santriwati berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bandongan = ModelsBandonganSantriwati::findOrFail($id);
        $bandongan->delete();
        return redirect()->route('pembina.santriwati-bandongan')->with('success', 'Data Jandongan Santriwati berhasil dihapus.');
    }
}
