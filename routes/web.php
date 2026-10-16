<?php

use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublikController::class, 'home'])->name('home');
Route::get('/profil', [PublikController::class, 'profilPage'])->name('profil');
Route::get('/produk', [PublikController::class, 'produk'])->name('produk');
Route::get('/artikel', [PublikController::class, 'artikel'])->name('artikel');
Route::get('/galeri', [PublikController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublikController::class, 'kontak'])->name('kontak');

Route::post('/kontak', function (Request $request) {
    $request->validate([
        'nama'  => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'pesan' => 'required|string|max:2000',
    ]);

    return redirect(route('kontak') . '#kirim-pesan')
        ->with('sukses', 'Terima kasih, pesan Anda sudah terkirim.');
})->name('kontak.kirim');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Profil: hanya edit & update (statis, tidak bisa ditambah/dihapus)
    Route::get('/profil', [AdminProfilController::class, 'edit'])->name('admin.profil');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('admin.profil.update');

    // Dinamis: tambah, edit, hapus
    $modul = [
        'produk'  => AdminProdukController::class,
        'artikel' => AdminArtikelController::class,
        'galeri'  => AdminGaleriController::class,
    ];

    foreach ($modul as $nama => $controller) {
        Route::resource($nama, $controller)
            ->except('show')
            ->parameters([$nama => $nama])
            ->names([
                'index'   => "admin.$nama",
                'create'  => "admin.$nama.tambah",
                'store'   => "admin.$nama.simpan",
                'edit'    => "admin.$nama.edit",
                'update'  => "admin.$nama.update",
                'destroy' => "admin.$nama.hapus",
            ]);
    }
});