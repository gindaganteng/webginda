<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $aktivitas = [];

        if ($a = Artikel::latest()->first()) {
            $aktivitas[] = ['warna' => 'navy', 'judul' => 'Artikel Terbaru', 'isi' => $a->judul, 'waktu' => $a->created_at];
        }
        if ($p = Produk::latest()->first()) {
            $aktivitas[] = ['warna' => 'emas', 'judul' => 'Produk / Layanan Terbaru', 'isi' => $p->nama, 'waktu' => $p->created_at];
        }
        if ($g = Galeri::latest()->first()) {
            $aktivitas[] = ['warna' => 'navy', 'judul' => 'Foto Galeri Terbaru', 'isi' => $g->judul, 'waktu' => $g->created_at];
        }

        return view('admin.dashboard', [
            'jmlArtikel' => Artikel::count(),
            'jmlProduk'  => Produk::count(),
            'jmlGaleri'  => Galeri::count(),
            'aktivitas'  => $aktivitas,
        ]);
    }
}