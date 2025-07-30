<?php

namespace App\Http\Controllers;

use App\Models\AlquranSantriwatis;
use Illuminate\Http\Request;

class PresensiAlquranSantriwati extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Kelompok Sorogan Alquran Santriwati',
            // Assuming you have a model to fetch data
            'alqurans' => AlquranSantriwatis::where('status', 'aktif')
                ->orderBy('created_at', 'desc')
                ->get(),
        ];

        return view('pembina.alquran.santriwati.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $alquran = AlquranSantriwatis::findOrFail($id);
        $santriwatis = $alquran->santriwatis()->where('status', 'aktif')->get();
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Tambah Presensi Sorogan Alquran Santriwati',
            // Assuming you have a model to fetch data
            'alquran' => $alquran,
            'santriwatis' => $santriwatis,
        ];

        return view('pembina.alquran.santriwati.create', $data);
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
        $alquranSantriwati = AlquranSantriwatis::findOrFail($id);
        $dataAlquranSantriwati = $alquranSantriwati->dataAlquranSantriwatis()->create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);
        foreach ($request->id_santriwati as $index => $idSantriwati) {
            $dataAlquranSantriwati->presensi()->create([
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }
        return redirect()->route('pembina.santriwati-alquran.show', ['id' => $alquranSantriwati->id_alquran_santriwati])
            ->with('success', 'Presensi Sorogan Alquran Santriwati berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataAlquranSantriwati = AlquranSantriwatis::findOrFail($id);
        $alqurans = $dataAlquranSantriwati->dataAlquranSantriwatis()->tanggal(request()->only(['tanggal']))->with('presensi')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Presensi Sorogan Alquran Santriwati',
            // Fetch the specific Alquran santriwati by ID
            'alqurans' => $alqurans,
            'kelompok' => $dataAlquranSantriwati,
            // Assuming you have a model to fetch presensi data
        ];



        return view('pembina.alquran.santriwati.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $alquranId, string $id)
    {
        $dataAlquranSantriwati = AlquranSantriwatis::findOrFail($alquranId);
        $alquran = $dataAlquranSantriwati->dataAlquranSantriwatis()->where('id_data_Alquran_santriwati', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Edit Presensi Sorogan Alquran Santriwati',
            // Fetch the specific Alquran santriwati by ID
            'alquran' => $alquran,
            'kelompok' => $dataAlquranSantriwati,
        ];


        return view('pembina.alquran.santriwati.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $alquranId, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            // 'kegiatan' => 'required',
        ]);
        $dataAlquranSantriwati = AlquranSantriwatis::findOrFail($alquranId);
        $alquran = $dataAlquranSantriwati->dataAlquranSantriwatis()->where('id_data_Alquran_santriwati', $id)->firstOrFail();
        $alquran->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan ?? null,
        ]);

        foreach ($alquran->presensi as $presensi) {
            $presensi->delete();
        }
        foreach ($request->id_santriwati as $index => $idSantriwati) {
            $alquran->presensi()->create([
                'id_santriwati' => $idSantriwati,
                'status' => $request->status[$index],
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        return redirect()->route('pembina.santriwati-alquran.show', ['id' => $dataAlquranSantriwati->id_alquran_santriwati])
            ->with('success', 'Presensi Sorogan Alquran Santriwati berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail(string $alquranId, string $id)
    {
        $dataAlquranSantriwati = AlquranSantriwatis::findOrFail($alquranId);
        $alquran = $dataAlquranSantriwati->dataAlquranSantriwatis()->where('id_data_Alquran_santriwati', $id)->with('presensi')->firstOrFail();
        $data = [
            'selected' => 'Alquran Santriwati',
            'page' => 'Alquran Santriwati',
            'title' => 'Detail Presensi Sorogan Alquran Santriwati',
            // Fetch the specific Alquran santriwati by ID
            'alquran' => $alquran,
            'kelompok' => $dataAlquranSantriwati,
        ];

        return view('pembina.alquran.santriwati.detail', $data);
    }
}
