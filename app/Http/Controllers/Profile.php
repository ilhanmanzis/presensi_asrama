<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile as ModelsProfile;

class Profile extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' =>  'Setting',
            'page' => 'Setting',
            'title' => 'Setting',
            'profile' => ModelsProfile::first()
        ];

        return view('admin/setting/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id = 1)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'ppn' => 'required|integer',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048', // Maksimal 2MB
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_hp.required' => 'Nomor Telepon tidak boleh kosong',
            'ppn.required' => 'PPN tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'logo.image' => 'logo harus berupa gambar',
            'logo.mimes' => 'logo harus berformat png, jpg, jpeg, atau webp',
            'logo.max' => 'logo harus berukuran max 2MB',
        ]);

        // Ambil data user
        $profile = ModelsProfile::findOrFail($id);

        // Update data
        $profile->name = $validated['name'];
        $profile->alamat = $validated['alamat'];
        $profile->no_hp = $validated['no_hp'];
        $profile->email = $validated['email'];
        $profile->ppn = $validated['ppn'];
        $profile->nsfp = $validated['nsfp'] ?? '';


        // Proses logo jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($profile->logo && Storage::disk('public')->exists('logo/' . $profile->logo)) {
                Storage::disk('public')->delete('logo/' . $profile->logo);
            }

            // Simpan logo baru
            $extension = $request->file('logo')->extension();
            $uuidName = Str::uuid() . '.' . $extension;

            // Simpan ke storage/app/public/logo
            $request->file('logo')->storeAs('logo', time() . $uuidName, 'public');


            // Simpan nama file ke database
            $profile->logo = time() . $uuidName;
        }

        // Simpan perubahan
        $profile->save();

        return redirect()->route('admin.setting')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
