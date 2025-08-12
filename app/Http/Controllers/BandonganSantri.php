<?php

namespace App\Http\Controllers;

use App\Models\BandonganSantri as ModelsBandonganSantri;
use App\Models\BandonganSantriwati;
use App\Models\PresensiBandonganSantri;
use App\Models\Santris;
use Illuminate\Http\Request;

class BandonganSantri extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Bandongan Santri',
            'page' => 'Bandongan Santri',
            'title' => 'Data Bandongan Santri',
            // Assuming you have a model to fetch data
            'bandongans' => ModelsBandonganSantri::tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        ];
        return view('pembina.bandongan.santri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Bandongan Santri',
            'page' => 'Bandongan Santri',
            'title' => 'Tambah Data Bandongan Santri',
            // Assuming you have a model to fetch active santris
            'santris' => Santris::where('status', 'aktif')->orderBy('nis', 'asc')->get()
        ];
        return view('pembina.bandongan.santri.create', $data);
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

        $bandongan = ModelsBandonganSantri::create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        foreach ($request->id_santri as $index => $idSantri) {
            PresensiBandonganSantri::create([
                'id_bandongan_santri' => $bandongan->id_bandongan_santri,
                'id_santri' => $idSantri,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santri-bandongan')->with('success', 'Data Bandongan Santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bandongan = ModelsBandonganSantri::with('presensi.santri')->findOrFail($id);
        $data = [
            'selected' => 'Bandongan Santri',
            'page' => 'Bandongan Santri',
            'title' => 'Detail Data Bandongan Santri',
            'bandongan' => $bandongan,
        ];
        return view('pembina.bandongan.santri.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bandongan = ModelsBandonganSantri::with(['presensi.santri'])->findOrFail($id);
        $data = [
            'selected' => 'Bandongan Santri',
            'page' => 'Bandongan Santri',
            'title' => 'Detail Data Bandongan Santri',
            'bandongan' => $bandongan,
        ];
        return view('pembina.bandongan.santri.detail', $data);
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

        $bandongan = ModelsBandonganSantri::findOrFail($id);
        $bandongan->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        // Update presensi if needed
        foreach ($request->id_santri as $index => $idSantri) {
            PresensiBandonganSantri::updateOrCreate(
                ['id_bandongan_santri' => $bandongan->id_bandongan_santri, 'id_santri' => $idSantri],
                [
                    'status' => $request->status[$index],
                    'catatan' => $request->catatan[$index] ?? null,
                ]
            );
        }

        return redirect()->route('pembina.santri-bandongan')->with('success', 'Data Bandongan Santri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bandongan = ModelsBandonganSantri::findOrFail($id);
        $bandongan->delete();
        return redirect()->route('pembina.santri-bandongan')->with('success', 'Data Jandongan Santri berhasil dihapus.');
    }
}
