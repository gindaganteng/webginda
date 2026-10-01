<?php

use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/profil', 'profil')->name('profil');
Route::view('/artikel', 'artikel')->name('artikel');
Route::view('/galeri', 'galeri')->name('galeri');
Route::view('/produk', 'produk')->name('produk');
Route::view('/kontak', 'kontak')->name('kontak');

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
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel');
    Route::get('/produk', [AdminProdukController::class, 'index'])->name('admin.produk');
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri');
});