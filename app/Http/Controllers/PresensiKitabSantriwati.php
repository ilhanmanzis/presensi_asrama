<?php

namespace App\Http\Controllers;

use App\Models\KitabSantriwatis;
use Illuminate\Http\Request;

class PresensiKitabSantriwati extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Kelompok Sorogan Kitab Santriwati',
            // Assuming you have a model to fetch data
            'kitabs' => KitabSantriwatis::where('status', 'aktif')
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('pembina.kitab.santriwati.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $kitab = KitabSantriwatis::findOrFail($id);
        $santriwatis = $kitab->santriwatis()->where('status', 'aktif')->get();
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Tambah Presensi Sorogan Kitab Santriwati',
            // Assuming you have a model to fetch data
            'kitab' => $kitab,
            'santriwatis' => $santriwatis,
        ];

        return view('pembina.kitab.santriwati.create', $data);
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
        $kitabSantriwati = KitabSantriwatis::findOrFail($id);
        $dataKitabSantriwati = $kitabSantriwati->dataKitabSantriwatis()->create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);
        foreach ($request->id_santriwati as $index => $idSantriwati) {
            $dataKitabSantriwati->presensi()->create([
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }
        return redirect()->route('pembina.santriwati-kitab.show', ['id' => $kitabSantriwati->id_kitab_santriwati])
            ->with('success', 'Presensi Sorogan Kitab Santriwati berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataKitabSantriwati = KitabSantriwatis::findOrFail($id);
        $kitabs = $dataKitabSantriwati->dataKitabSantriwatis()->tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Presensi Sorogan Kitab Santriwati',
            // Fetch the specific kitab santriwati by ID
            'kitabs' => $kitabs,
            'kelompok' => $dataKitabSantriwati,
            // Assuming you have a model to fetch presensi data
        ];



        return view('pembina.kitab.santriwati.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kitabId, string $id)
    {
        $dataKitabSantriwati = KitabSantriwatis::findOrFail($kitabId);
        $kitab = $dataKitabSantriwati->dataKitabSantriwatis()->where('id_data_kitab_santriwati', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Edit Presensi Sorogan Kitab Santriwati',
            // Fetch the specific kitab santriwati by ID
            'kitab' => $kitab,
            'kelompok' => $dataKitabSantriwati,
        ];


        return view('pembina.kitab.santriwati.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kitabId,  string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            // 'kegiatan' => 'required',
        ]);
        $dataKitabSantriwati = KitabSantriwatis::findOrFail($kitabId);
        $kitab = $dataKitabSantriwati->dataKitabSantriwatis()->where('id_data_kitab_santriwati', $id)->firstOrFail();
        $kitab->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);

        foreach ($kitab->presensi as $presensi) {
            $presensi->delete();
        }
        foreach ($request->id_santriwati as $index => $idSantriwati) {
            $kitab->presensi()->create([
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santriwati-kitab.show', ['id' => $dataKitabSantriwati->id_kitab_santriwati])
            ->with('success', 'Presensi Sorogan Kitab Santriwati berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kitabId, string $id)
    {
        $dataKitabSantriwati = KitabSantriwatis::findOrFail($kitabId);
        $kitab = $dataKitabSantriwati->datakitabSantriwatis()->where('id_data_kitab_santriwati', $id)->firstOrFail();

        $kitab->delete();
        return redirect()->route('pembina.santriwati-kitab.show', ['id' => $kitabId])
            ->with('success', 'Presensi Sorogan Kitab Santriwati berhasil dihapus.');
    }

    public function detail(string $kitabId, string $id)
    {
        $dataKitabSantriwati = KitabSantriwatis::findOrFail($kitabId);
        $kitab = $dataKitabSantriwati->dataKitabSantriwatis()->where('id_data_kitab_santriwati', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Kitab Santriwati',
            'page' => 'Kitab Santriwati',
            'title' => 'Detail Presensi Sorogan Kitab Santriwati',
            // Fetch the specific kitab santriwati by ID
            'kitab' => $kitab,
            'kelompok' => $dataKitabSantriwati,
        ];

        return view('pembina.kitab.santriwati.detail', $data);
    }
}
