<?php

namespace App\Http\Controllers;

use App\Models\Asramas;
use Illuminate\Http\Request;

class AsramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Asrama',
            'page' => 'Asrama',
            'title' => 'Data Asrama',
            'asramas' => Asramas::paginate(10)->withQueryString(),
        ];
        return view('admin/asrama/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Asrama',
            'page' => 'Asrama',
            'title' => 'Tambah Asrama',
        ];
        return view('admin/asrama/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Asrama harus diisi.',
            'name.string' => 'Nama Asrama harus berupa teks.',
            'name.max' => 'Nama Asrama tidak boleh lebih dari 255 karakter.',
        ]);

        Asramas::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.asrama')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' => 'Asrama',
            'page' => 'Asrama',
            'title' => 'Data Asrama',
            'asrama' => Asramas::findOrFail($id),
        ];
        return view('admin/asrama/show', $data);
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
        ], [
            'name.required' => 'Nama Asrama harus diisi.',
            'name.string' => 'Nama Asrama harus berupa teks.',
            'name.max' => 'Nama Asrama tidak boleh lebih dari 255 karakter.',
        ]);

        $asrama = Asramas::findOrFail($id);
        $asrama->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.asrama')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asrama = Asramas::findOrFail($id);
        $asrama->delete();

        return redirect()->route('admin.asrama')->with('success', 'Data berhasil dihapus.');
    }
}
