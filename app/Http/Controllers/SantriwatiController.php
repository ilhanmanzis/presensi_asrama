<?php

namespace App\Http\Controllers;

use App\Models\Asramas;
use App\Models\Kelas;
use App\Models\Santriwatis;
use Illuminate\Http\Request;

class SantriwatiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Santriwati',
            'page' => 'Santriwati',
            'title' => 'Data Santriwati',
            'santriwatis' => Santriwatis::with(['kelas', 'asrama'])->orderBy('nis', 'asc')->filter(request()->only(['santriwati']))->paginate(10)->withQueryString(),
        ];

        return view('admin/santriwati/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Santriwati',
            'page' => 'Santriwati',
            'title' => 'Tambah Santriwati',
            'kelass' => Kelas::all(),
            'asramas' => Asramas::all()
        ];
        return view('admin/santriwati/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:santriwatis,nis',
            'asrama' => 'required|exists:asramas,id_asrama',
            'kelas' => 'required|exists:kelas,id_kelas',
        ], [
            'name.required' => 'Nama Santriwati harus diisi.',
            'nis.required' => 'NIS Santriwati harus diisi.',
            'asrama.required' => 'Asrama Santriwati harus dipilih.',
            'kelas.required' => 'Kelas Santriwati harus dipilih.',
        ]);

        Santriwatis::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'id_asrama' => $request->asrama,
            'id_kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.santriwati')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' => 'Santriwati',
            'page' => 'Santriwati',
            'title' => 'Data Santriwati',
            'santriwati' => Santriwatis::with(['kelas', 'asrama'])->findOrFail($id),
            'kelass' => Kelas::all(),
            'asramas' => Asramas::all()
        ];
        return view('admin/santriwati/show', $data);
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
            'nis' => 'required|string|max:20|unique:santriwatis,nis,' . $id . ',id_santriwati',
            'asrama' => 'required|exists:asramas,id_asrama',
            'kelas' => 'required|exists:kelas,id_kelas',
        ], [
            'name.required' => 'Nama Santriwati harus diisi.',
            'nis.required' => 'NIS Santriwati harus diisi.',
            'asrama.required' => 'Asrama Santriwati harus dipilih.',
            'kelas.required' => 'Kelas Santriwati harus dipilih.',
        ]);

        $santriwati = Santriwatis::findOrFail($id);
        $santriwati->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'id_asrama' => $request->asrama,
            'id_kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.santriwati')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santriwati = Santriwatis::findOrFail($id);
        $santriwati->delete();

        return redirect()->route('admin.santriwati')->with('success', 'Data berhasil dihapus.');
    }

    public function cari(Request $request)
    {
        $keyword = $request->query('q');

        $santri = Santriwatis::where('name', 'like', "%{$keyword}%")
            ->orWhere('nis', 'like', "%{$keyword}%")
            ->get();

        // dd($santri);
        return response()->json($santri);
    }
}
