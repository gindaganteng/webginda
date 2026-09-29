<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/profil', 'profil')->name('profil');
Route::view('/artikel', 'artikel')->name('artikel');
Route::view('/galeri', 'galeri')->name('galeri');
Route::view('/produk', 'produk')->name('produk');
Route::view('/kontak', 'kontak')->name('kontak');

Route::post('/kontak', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nama'  => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'pesan' => 'required|string|max:2000',
    ]);

    // TODO: simpan ke database atau kirim email di sini.

    return redirect(route('kontak') . '#kirim-pesan')
        ->with('sukses', 'Terima kasih, pesan Anda sudah terkirim.');
})->name('kontak.kirim');