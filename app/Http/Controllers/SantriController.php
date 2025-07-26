<?php

namespace App\Http\Controllers;

use App\Models\Asramas;
use App\Models\Kelas;
use App\Models\Santris;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Santri',
            'page' => 'Santri',
            'title' => 'Data Santri',
            'santris' => Santris::with(['asrama', 'kelas'])->paginate(10)->withQueryString(),
        ];

        return view('admin/santri/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Santri',
            'page' => 'Santri',
            'title' => 'Tambah Santri',
            'kelass' => Kelas::all(),
            'asramas' => Asramas::all()
        ];
        return view('admin/santri/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:santris,nis',
            'asrama' => 'required|exists:asramas,id_asrama',
            'kelas' => 'required|exists:kelas,id_kelas',
        ], [
            'name.required' => 'Nama Santri harus diisi.',
            'nis.required' => 'NIS Santri harus diisi.',
            'asrama.required' => 'Asrama Santri harus dipilih.',
            'kelas.required' => 'Kelas Santri harus dipilih.',
        ]);

        Santris::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'id_asrama' => $request->asrama,
            'id_kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.santri')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $santri = Santris::with(['asrama', 'kelas'])->findOrFail($id);

        $data = [
            'selected' => 'Santri',
            'page' => 'Santri',
            'title' => 'Detail Santri',
            'santri' => $santri,
            'asramas' => Asramas::all(),
            'kelass' => Kelas::all()
        ];

        return view('admin/santri/show', $data);
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
            'nis' => 'required|string|max:20|unique:santris,nis,' . $id . ',id_santri',
            'asrama' => 'required|exists:asramas,id_asrama',
            'kelas' => 'required|exists:kelas,id_kelas',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'name.required' => 'Nama Santri harus diisi.',
            'nis.required' => 'NIS Santri harus diisi.',
            'asrama.required' => 'Asrama Santri harus dipilih.',
            'kelas.required' => 'Kelas Santri harus dipilih.',
            'status.required' => 'Status Santri harus dipilih.',
            'status.in' => 'Status Santri harus salah satu dari: aktif, nonaktif',
        ]);

        $santri = Santris::findOrFail($id);
        $santri->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'id_asrama' => $request->asrama,
            'id_kelas' => $request->kelas,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.santri')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santri = Santris::findOrFail($id);
        $santri->delete();

        return redirect()->route('admin.santri')->with('success', 'Data berhasil dihapus.');
    }

    public function cari(Request $request)
    {
        $keyword = $request->query('q');

        $santri = Santris::where('name', 'like', "%{$keyword}%")
            ->orWhere('nis', 'like', "%{$keyword}%")
            ->get();

        // dd($santri);
        return response()->json($santri);
    }
}
