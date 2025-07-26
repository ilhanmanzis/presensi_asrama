<?php

namespace App\Http\Controllers;

use App\Models\AlquranSantris;
use App\Models\AlquranSantriwatis;
use App\Models\Asramas;
use App\Models\Ekstrakurikulers;
use App\Models\Kelas;
use App\Models\KitabSantris;
use App\Models\KitabSantriwatis;
use App\Models\Pengeluarans;
use App\Models\Santris;
use App\Models\Santriwatis;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $asrama = Asramas::count();
        $kelas = Kelas::count();
        $ekstrakurikuler = Ekstrakurikulers::count();

        // santri
        $santri = Santris::count();
        $santriAktif = Santris::where('status', 'aktif')->count();
        $kitabSantri = KitabSantris::where('status', 'aktif')->count();
        $alquranSantri = AlquranSantris::where('status', 'aktif')->count();

        // santri
        $santriwati = Santriwatis::count();
        $santriwatiAktif = Santriwatis::where('status', 'aktif')->count();
        $kitabSantriwati = KitabSantriwatis::where('status', 'aktif')->count();
        $alquranSantriwati = AlquranSantriwatis::where('status', 'aktif')->count();

        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
            'asrama' => $asrama,
            'kelas' => $kelas,
            'ekstrakurikuler' => $ekstrakurikuler,
            'santri' => $santri,
            'santriAktif' => $santriAktif,
            'kitabSantri' => $kitabSantri,
            'alquranSantri' => $alquranSantri,
            'santriwati' => $santriwati,
            'santriwatiAktif' => $santriwatiAktif,
            'kitabSantriwati' => $kitabSantriwati,
            'alquranSantriwati' => $alquranSantriwati,
        ];


        return view('dashboard', $data);
    }

    public function pembina(Request $request)
    {

        $asrama = Asramas::count();
        $kelas = Kelas::count();
        $ekstrakurikuler = Ekstrakurikulers::count();

        // santri
        $santri = Santris::count();
        $santriAktif = Santris::where('status', 'aktif')->count();
        $kitabSantri = KitabSantris::where('status', 'aktif')->count();
        $alquranSantri = AlquranSantris::where('status', 'aktif')->count();

        // santri
        $santriwati = Santriwatis::count();
        $santriwatiAktif = Santriwatis::where('status', 'aktif')->count();
        $kitabSantriwati = KitabSantriwatis::where('status', 'aktif')->count();
        $alquranSantriwati = AlquranSantriwatis::where('status', 'aktif')->count();

        $data = [
            'selected' =>  'Dashboard',
            'page' => 'Dashboard',
            'title' => 'Dashboard',
            'asrama' => $asrama,
            'kelas' => $kelas,
            'ekstrakurikuler' => $ekstrakurikuler,
            'santri' => $santri,
            'santriAktif' => $santriAktif,
            'kitabSantri' => $kitabSantri,
            'alquranSantri' => $alquranSantri,
            'santriwati' => $santriwati,
            'santriwatiAktif' => $santriwatiAktif,
            'kitabSantriwati' => $kitabSantriwati,
            'alquranSantriwati' => $alquranSantriwati,
        ];


        return view('dashboard', $data);
    }



    public function home()
    {
        $user = Auth::user();


        if (!$user) {
            return redirect('login')->with('message', 'Silakan login terlebih dahulu');
        }
        if ($user->role == 'admin') {
            return redirect(route('admin.dashboard'));
        } elseif ($user->role == 'pembina') {
            return redirect(route('pembina.dashboard'));
        } else {
            return redirect('login');
        }
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
