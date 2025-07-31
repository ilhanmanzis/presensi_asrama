<?php

namespace App\Http\Controllers;

use App\Imports\SantriImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'selected' => 'Import Excel',
            'page' => 'Import Excel',
            'title' => 'Import Data Santri dan Santriwati',
            // Assuming you have a model to fetch data
        ];
        return view('admin.import.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SantriImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
