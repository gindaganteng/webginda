<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    public function index(Request $request)
    {
        $semua = collect([
            ['nama' => 'Seragam Putra', 'kategori' => 'Atasan Sekolah', 'harga' => 1000000, 'gambar' => 'produk-1.jpg'],
            ['nama' => 'Topi-Dasi', 'kategori' => 'Aksesoris', 'harga' => 100000, 'gambar' => 'produk-2.jpg'],
        ])->map(fn ($p) => (object) $p);

        $cari = trim((string) $request->query('q'));

        $produks = $semua
            ->when($cari, fn ($c) => $c->filter(fn ($p) => str_contains(strtolower($p->nama), strtolower($cari))))
            ->values();

        return view('admin.produk.index', [
            'produks' => $produks,
            'cari' => $cari,
        ]);
    }
}
