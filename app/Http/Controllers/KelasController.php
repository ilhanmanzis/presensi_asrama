<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Kelas',
            'page' => 'Kelas',
            'title' => 'Data Kelas',
            'kelass' => Kelas::paginate(10)->withQueryString(),
        ];

        // dd($data);

        return view('admin/kelas/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Kelas',
            'page' => 'Kelas',
            'title' => 'Tambah Kelas',
        ];
        return view('admin/kelas/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Kelas harus diisi.',
            'name.string' => 'Nama Kelas harus berupa teks.',
            'name.max' => 'Nama Kelas tidak boleh lebih dari 255 karakter.',
        ]);

        Kelas::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.kelas')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' => 'Kelas',
            'page' => 'Kelas',
            'title' => 'Data Kelas',
            'kelas' => Kelas::findOrFail($id),
        ];
        return view('admin/kelas/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'selected' => 'Kelas',
            'page' => 'Kelas',
            'title' => 'Edit Kelas',
            'kelas' => Kelas::findOrFail($id),
        ];
        return view('admin/kelas/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Kelas harus diisi.',
            'name.string' => 'Nama Kelas harus berupa teks.',
            'name.max' => 'Nama Kelas tidak boleh lebih dari 255 karakter.',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.kelas')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas')->with('success', 'Data berhasil dihapus.');
    }
}
