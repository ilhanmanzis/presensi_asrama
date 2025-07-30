<?php

use App\Http\Controllers\AlquranSantriController;
use App\Http\Controllers\AlquranSantriwatiController;
use App\Http\Controllers\AsramaController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BandonganSantri;
use App\Http\Controllers\BandonganSantriwati;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\JamaahSantri;
use App\Http\Controllers\JamaahSantriwati;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KitabSantriController;
use App\Http\Controllers\KitabSantriwatiController;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\ManajemenUser;
use App\Http\Controllers\PresensiAlquranSantri;
use App\Http\Controllers\PresensiAlquranSantriwati;
use App\Http\Controllers\PresensiEkstrakurikulerController;
use App\Http\Controllers\PresensiKitabSantri;
use App\Http\Controllers\PresensiKitabSantriwati;
use App\Http\Controllers\Profile;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SantriwatiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'home'])->name('home');

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [Dashboard::class, 'home'])->name('home');

    Route::get('/backup', [BackupController::class, 'index'])->name('backup');
    Route::post('/backup', [BackupController::class, 'backup'])->name('backup.run');

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    //manajemen user
    Route::get('/users', [ManajemenUser::class, 'index'])->name('users');
    Route::get('/users/create', [ManajemenUser::class, 'create'])->name('users.create');
    Route::post('/users', [ManajemenUser::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [ManajemenUser::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [ManajemenUser::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [ManajemenUser::class, 'destroy'])->name('users.delete');

    //setting
    Route::get('/setting', [Profile::class, 'index'])->name('setting');
    Route::put('/setting', [Profile::class, 'update'])->name('setting.update');



    //data asrama
    Route::get('/asramas', [AsramaController::class, 'index'])->name('asrama');
    Route::get('/asramas/create', [AsramaController::class, 'create'])->name('asrama.create');
    Route::post('/asramas/store', [AsramaController::class, 'store'])->name('asrama.store');
    Route::get('/asramas/{id}', [AsramaController::class, 'show'])->name('asrama.show');
    Route::put('/asramas/update/{id}', [AsramaController::class, 'update'])->name('asrama.update');
    Route::delete('/asramas/store/{id}', [AsramaController::class, 'destroy'])->name('asrama.delete');

    //data kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
    Route::put('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/store/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');

    //data Santri
    Route::get('/santri', [SantriController::class, 'index'])->name('santri');
    Route::get('/santri/create', [SantriController::class, 'create'])->name('santri.create');
    Route::post('/santri/store', [SantriController::class, 'store'])->name('santri.store');
    Route::get('/santri/{id}', [SantriController::class, 'show'])->name('santri.show');
    Route::put('/santri/update/{id}', [SantriController::class, 'update'])->name('santri.update');
    Route::delete('/santri/store/{id}', [SantriController::class, 'destroy'])->name('santri.delete');

    //data Santriwati
    Route::get('/santriwati', [SantriwatiController::class, 'index'])->name('santriwati');
    Route::get('/santriwati/create', [SantriwatiController::class, 'create'])->name('santriwati.create');
    Route::post('/santriwati/store', [SantriwatiController::class, 'store'])->name('santriwati.store');
    Route::get('/santriwati/{id}', [SantriwatiController::class, 'show'])->name('santriwati.show');
    Route::put('/santriwati/update/{id}', [SantriwatiController::class, 'update'])->name('santriwati.update');
    Route::delete('/santriwati/store/{id}', [SantriwatiController::class, 'destroy'])->name('santriwati.delete');

    //data kitab santri
    Route::get('/santri-kitabs', [KitabSantriController::class, 'index'])->name('santri-kitab');
    Route::get('/santri-kitabs/create', [KitabSantriController::class, 'create'])->name('santri-kitab.create');
    Route::post('/santri-kitabs/store', [KitabSantriController::class, 'store'])->name('santri-kitab.store');
    Route::get('/santri-kitabs/{id}', [KitabSantriController::class, 'show'])->name('santri-kitab.show');
    Route::put('/santri-kitabs/update/{id}', [KitabSantriController::class, 'update'])->name('santri-kitab.update');
    Route::delete('/santri-kitabs/store/{id}', [KitabSantriController::class, 'destroy'])->name('santri-kitab.delete');
    Route::get('/santri-kitabs/{id}/anggota', [KitabSantriController::class, 'anggota'])->name('santri-kitab.anggota');
    Route::post('/santri-kitabs/anggota/{id}/simpan', [KitabSantriController::class, 'simpanAnggota'])->name('santri-kitab.simpan');

    //data kitab santriwati
    Route::get('/santriwati-kitabs', [KitabSantriwatiController::class, 'index'])->name('santriwati-kitab');
    Route::get('/santriwati-kitabs/create', [KitabSantriwatiController::class, 'create'])->name('santriwati-kitab.create');
    Route::post('/santriwati-kitabs/store', [KitabSantriwatiController::class, 'store'])->name('santriwati-kitab.store');
    Route::get('/santriwati-kitabs/{id}', [KitabSantriwatiController::class, 'show'])->name('santriwati-kitab.show');
    Route::put('/santriwati-kitabs/update/{id}', [KitabSantriwatiController::class, 'update'])->name('santriwati-kitab.update');
    Route::delete('/santriwati-kitabs/store/{id}', [KitabSantriwatiController::class, 'destroy'])->name('santriwati-kitab.delete');
    Route::get('/santriwati-kitabs/{id}/anggota', [KitabSantriwatiController::class, 'anggota'])->name('santriwati-kitab.anggota');
    Route::post('/santriwati-kitabs/anggota/{id}/simpan', [KitabSantriwatiController::class, 'simpanAnggota'])->name('santriwati-kitab.simpan');

    //data alquran santri
    Route::get('/santri-alqurans', [AlquranSantriController::class, 'index'])->name('santri-alquran');
    Route::get('/santri-alqurans/create', [AlquranSantriController::class, 'create'])->name('santri-alquran.create');
    Route::post('/santri-alqurans/store', [AlquranSantriController::class, 'store'])->name('santri-alquran.store');
    Route::get('/santri-alqurans/{id}', [AlquranSantriController::class, 'show'])->name('santri-alquran.show');
    Route::put('/santri-alqurans/update/{id}', [AlquranSantriController::class, 'update'])->name('santri-alquran.update');
    Route::delete('/santri-alqurans/store/{id}', [AlquranSantriController::class, 'destroy'])->name('santri-alquran.delete');
    Route::get('/santri-alqurans/{id}/anggota', [AlquranSantriController::class, 'anggota'])->name('santri-alquran.anggota');
    Route::post('/santri-alqurans/anggota/{id}/simpan', [AlquranSantriController::class, 'simpanAnggota'])->name('santri-alquran.simpan');

    //data alquran santriwati
    Route::get('/santriwati-alqurans', [AlquranSantriwatiController::class, 'index'])->name('santriwati-alquran');
    Route::get('/santriwati-alqurans/create', [AlquranSantriwatiController::class, 'create'])->name('santriwati-alquran.create');
    Route::post('/santriwati-alqurans/store', [AlquranSantriwatiController::class, 'store'])->name('santriwati-alquran.store');
    Route::get('/santriwati-alqurans/{id}', [AlquranSantriwatiController::class, 'show'])->name('santriwati-alquran.show');
    Route::put('/santriwati-alqurans/update/{id}', [AlquranSantriwatiController::class, 'update'])->name('santriwati-alquran.update');
    Route::delete('/santriwati-alqurans/store/{id}', [AlquranSantriwatiController::class, 'destroy'])->name('santriwati-alquran.delete');
    Route::get('/santriwati-alqurans/{id}/anggota', [AlquranSantriwatiController::class, 'anggota'])->name('santriwati-alquran.anggota');
    Route::post('/santriwati-alqurans/anggota/{id}/simpan', [AlquranSantriwatiController::class, 'simpanAnggota'])->name('santriwati-alquran.simpan');

    //cari santri
    Route::get('/cari-santri', [SantriController::class, 'cari'])->name('api.cari-santri');
    Route::get('/cari-santriwati', [SantriwatiController::class, 'cari'])->name('api.cari-santriwati');

    //data ekstrakurikuler
    Route::get('/ekstrakurikulers', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler');
    Route::get('/ekstrakurikulers/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakurikulers/store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikulers/{id}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
    Route::put('/ekstrakurikulers/update/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakurikulers/store/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.delete');
});

//pembina
Route::middleware(['auth', 'role:pembina'])->prefix('pembina')->as('pembina.')->group(function () {
    Route::get('/', [Dashboard::class, 'home'])->name('home');
    Route::get('/dashboard', [Dashboard::class, 'pembina'])->name('dashboard');

    //jamaah santri
    Route::get('/santri-jamaah', [JamaahSantri::class, 'index'])->name('santri-jamaah');
    Route::get('/santri-jamaah/create', [JamaahSantri::class, 'create'])->name('santri-jamaah.create');
    Route::post('/santri-jamaah/store', [JamaahSantri::class, 'store'])->name('santri-jamaah.store');
    Route::get('/santri-jamaah/{id}', [JamaahSantri::class, 'show'])->name('santri-jamaah.show');
    Route::get('/santri-jamaah/detail/{id}', [JamaahSantri::class, 'edit'])->name('santri-jamaah.detail');
    Route::put('/santri-jamaah/update/{id}', [JamaahSantri::class, 'update'])->name('santri-jamaah.update');

    //jamaah santriwati
    Route::get('/santriwati-jamaah', [JamaahSantriwati::class, 'index'])->name('santriwati-jamaah');
    Route::get('/santriwati-jamaah/create', [JamaahSantriwati::class, 'create'])->name('santriwati-jamaah.create');
    Route::post('/santriwati-jamaah/store', [JamaahSantriwati::class, 'store'])->name('santriwati-jamaah.store');
    Route::get('/santriwati-jamaah/{id}', [JamaahSantriwati::class, 'show'])->name('santriwati-jamaah.show');
    Route::get('/santriwati-jamaah/detail/{id}', [JamaahSantriwati::class, 'edit'])->name('santriwati-jamaah.detail');
    Route::put('/santriwati-jamaah/update/{id}', [JamaahSantriwati::class, 'update'])->name('santriwati-jamaah.update');

    //bandongan santriwati
    Route::get('/santriwati-bandongan', [BandonganSantriwati::class, 'index'])->name('santriwati-bandongan');
    Route::get('/santriwati-bandongan/create', [BandonganSantriwati::class, 'create'])->name('santriwati-bandongan.create');
    Route::post('/santriwati-bandongan/store', [BandonganSantriwati::class, 'store'])->name('santriwati-bandongan.store');
    Route::get('/santriwati-bandongan/{id}', [BandonganSantriwati::class, 'show'])->name('santriwati-bandongan.show');
    Route::get('/santriwati-bandongan/detail/{id}', [BandonganSantriwati::class, 'edit'])->name('santriwati-bandongan.detail');
    Route::put('/santriwati-bandongan/update/{id}', [BandonganSantriwati::class, 'update'])->name('santriwati-bandongan.update');

    //bandongan santri
    Route::get('/santri-bandongan', [BandonganSantri::class, 'index'])->name('santri-bandongan');
    Route::get('/santri-bandongan/create', [BandonganSantri::class, 'create'])->name('santri-bandongan.create');
    Route::post('/santri-bandongan/store', [BandonganSantri::class, 'store'])->name('santri-bandongan.store');
    Route::get('/santri-bandongan/{id}', [BandonganSantri::class, 'show'])->name('santri-bandongan.show');
    Route::get('/santri-bandongan/detail/{id}', [BandonganSantri::class, 'edit'])->name('santri-bandongan.detail');
    Route::put('/santri-bandongan/update/{id}', [BandonganSantri::class, 'update'])->name('santri-bandongan.update');

    //kitab santri
    Route::get('/santri-kitab', [PresensiKitabSantri::class, 'index'])->name('santri-kitab');
    Route::get('/santri-kitab/{id}/create', [PresensiKitabSantri::class, 'create'])->name('santri-kitab.create');
    Route::post('/santri-kitab/{id}/store', [PresensiKitabSantri::class, 'store'])->name('santri-kitab.store');
    Route::get('/santri-kitab/{id}', [PresensiKitabSantri::class, 'show'])->name('santri-kitab.show');
    Route::get('/santri-kitab/{kitabId}/edit/{id}', [PresensiKitabSantri::class, 'edit'])->name('santri-kitab.edit');
    Route::get('/santri-kitab/{kitabId}/detail/{id}', [PresensiKitabSantri::class, 'detail'])->name('santri-kitab.detail');
    Route::put('/santri-kitab/{kitabId}/update/{id}', [PresensiKitabSantri::class, 'update'])->name('santri-kitab.update');

    //kitab santriwati
    Route::get('/santriwati-kitab', [PresensiKitabSantriwati::class, 'index'])->name('santriwati-kitab');
    Route::get('/santriwati-kitab/{id}/create', [PresensiKitabSantriwati::class, 'create'])->name('santriwati-kitab.create');
    Route::post('/santriwati-kitab/{id}/store', [PresensiKitabSantriwati::class, 'store'])->name('santriwati-kitab.store');
    Route::get('/santriwati-kitab/{id}', [PresensiKitabSantriwati::class, 'show'])->name('santriwati-kitab.show');
    Route::get('/santriwati-kitab/{kitabId}/edit/{id}', [PresensiKitabSantriwati::class, 'edit'])->name('santriwati-kitab.edit');
    Route::get('/santriwati-kitab/{kitabId}/detail/{id}', [PresensiKitabSantriwati::class, 'detail'])->name('santriwati-kitab.detail');
    Route::put('/santriwati-kitab/{kitabId}/update/{id}', [PresensiKitabSantriwati::class, 'update'])->name('santriwati-kitab.update');


    //alquran santri
    Route::get('/santri-alquran', [PresensiAlquranSantri::class, 'index'])->name('santri-alquran');
    Route::get('/santri-alquran/{id}/create', [PresensiAlquranSantri::class, 'create'])->name('santri-alquran.create');
    Route::post('/santri-alquran/{id}/store', [PresensiAlquranSantri::class, 'store'])->name('santri-alquran.store');
    Route::get('/santri-alquran/{id}', [PresensiAlquranSantri::class, 'show'])->name('santri-alquran.show');
    Route::get('/santri-alquran/{alquranId}/edit/{id}', [PresensiAlquranSantri::class, 'edit'])->name('santri-alquran.edit');
    Route::get('/santri-alquran/{alquranId}/detail/{id}', [PresensiAlquranSantri::class, 'detail'])->name('santri-alquran.detail');
    Route::put('/santri-alquran/{alquranId}/update/{id}', [PresensiAlquranSantri::class, 'update'])->name('santri-alquran.update');

    //alquran santriwati
    Route::get('/santriwati-alquran', [PresensiAlquranSantriwati::class, 'index'])->name('santriwati-alquran');
    Route::get('/santriwati-alquran/{id}/create', [PresensiAlquranSantriwati::class, 'create'])->name('santriwati-alquran.create');
    Route::post('/santriwati-alquran/{id}/store', [PresensiAlquranSantriwati::class, 'store'])->name('santriwati-alquran.store');
    Route::get('/santriwati-alquran/{id}', [PresensiAlquranSantriwati::class, 'show'])->name('santriwati-alquran.show');
    Route::get('/santriwati-alquran/{alquranId}/edit/{id}', [PresensiAlquranSantriwati::class, 'edit'])->name('santriwati-alquran.edit');
    Route::get('/santriwati-alquran/{alquranId}/detail/{id}', [PresensiAlquranSantriwati::class, 'detail'])->name('santriwati-alquran.detail');
    Route::put('/santriwati-alquran/{alquranId}/update/{id}', [PresensiAlquranSantriwati::class, 'update'])->name('santriwati-alquran.update');

    //ekstrakurikuler
    Route::get('/ekstrakurikuler', [PresensiEkstrakurikulerController::class, 'index'])->name('ekstrakurikuler');
    Route::get('/ekstrakurikuler/create', [PresensiEkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakurikuler/store', [PresensiEkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{id}', [PresensiEkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
    Route::get('/ekstrakurikuler/detail/{id}', [PresensiEkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.detail');
    Route::put('/ekstrakurikuler/update/{id}', [PresensiEkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
});




Route::middleware(['auth', 'role:admin,pembina'])->group(function () {
    //edit akun
    Route::get('/users/edit/{id}', [ManajemenUser::class, 'edit'])->name('users.edit');
    Route::put('/users/edit/{id}', [ManajemenUser::class, 'updateProfile'])->name('users.update.profile');


    //laporan
    Route::get('/laporan', [Laporan::class, 'index'])->name('laporan');
    Route::post('/laporan/jamaah', [Laporan::class, 'jamaah'])->name('laporan.jamaah');
    Route::post('/laporan/bandongan', [Laporan::class, 'bandongan'])->name('laporan.bandongan');
    Route::post('/laporan/kitab', [Laporan::class, 'kitab'])->name('laporan.kitab');
    Route::post('/laporan/alquran', [Laporan::class, 'alquran'])->name('laporan.alquran');
    Route::post('/laporan/ekstrakurikuler', [Laporan::class, 'ekstrakurikuler'])->name('laporan.ekstrakurikuler');
});

Route::get('/login', [Auth::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [Auth::class, 'store'])->name('auth.login');
Route::get('/logout', [Auth::class, 'destroy'])->name('logout');
