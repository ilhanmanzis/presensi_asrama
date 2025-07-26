<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikulers;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Data Ekstrakurikuler',
            'ekstrakurikulers' => Ekstrakurikulers::paginate(10)->withQueryString(),
        ];

        // dd($data);

        return view('admin/ekstrakurikuler/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Tambah Ekstrakurikuler',
        ];
        return view('admin/ekstrakurikuler/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Ekstrakurikuler harus diisi.',
            'name.string' => 'Nama Ekstrakurikuler harus berupa teks.',
            'name.max' => 'Nama Ekstrakurikuler tidak boleh lebih dari 255 karakter.',
        ]);

        Ekstrakurikulers::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Data Ekstrakurikuler',
            'ekstrakurikuler' => Ekstrakurikulers::findOrFail($id),
        ];
        return view('admin/ekstrakurikuler/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'selected' => 'Ekstrakurikuler',
            'page' => 'Ekstrakurikuler',
            'title' => 'Edit Ekstrakurikuler',
            'ekstrakurikuler' => Ekstrakurikulers::findOrFail($id),
        ];
        return view('admin/ekstrakurikuler/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama Ekstrakurikuler harus diisi.',
            'name.string' => 'Nama Ekstrakurikuler harus berupa teks.',
            'name.max' => 'Nama Ekstrakurikuler tidak boleh lebih dari 255 karakter.',
        ]);

        $Ekstrakurikuler = Ekstrakurikulers::findOrFail($id);
        $Ekstrakurikuler->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Ekstrakurikuler = Ekstrakurikulers::findOrFail($id);
        $Ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Data berhasil dihapus.');
    }
}
