<?php

use App\Exports\SKeluarExport;
use App\Exports\SMasukExport;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\S_MasukController;
use App\Http\Controllers\S_KeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Maatwebsite\Excel\Facades\Excel;

// Rute untuk halaman beranda (login)
Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk login, registrasi, dan lainnya dari Laravel Auth
Auth::routes();

// Rute untuk dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Rute untuk halaman selamat datang
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Rute untuk admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Rute untuk manajemen suppliers
    Route::resource('suppliers', SupplierController::class);
    // Rute untuk manajemen jenis obat
    Route::resource('jenis', JenisController::class);
    // Rute untuk manajemen obat
    Route::resource('obat', ObatController::class);
    // Rute untuk manajemen stok masuk
    Route::resource('s_masuk', S_MasukController::class);
    // Rute untuk manajemen stok keluar
    Route::resource('s_keluar', S_KeluarController::class);
    // Rute untuk manajemen pengguna
    Route::resource('users', UserController::class);

    // Rute untuk ekspor dan impor data stok masuk dan keluar
    Route::get('export-smasuk', function () {
        return Excel::download(new SMasukExport, 'smasuk.xlsx');
    });
    Route::get('export-skeluar', function () {
        return Excel::download(new SKeluarExport, 'skeluar.xlsx');
    });

    Route::post('import-smasuk', [S_MasukController::class, 'import']);
    Route::post('import-skeluar', [S_KeluarController::class, 'import']);

    Route::get('notifikasi', function() {
        return view('admin.notifikasi.index');
    });
    Route::get('notifikasi/detail', function() {
        return view('admin.notifikasi.detail');
    });
});
