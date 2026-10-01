<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminGaleriController extends Controller
{
    public function index(Request $request)
    {
        $semua = collect([
            ['judul' => 'Neospragma', 'tanggal' => '2025-08-17', 'gambar' => 'galeri-1.jpg'],
            ['judul' => 'Idul Adha 1447 Hijriah', 'tanggal' => '2024-05-18', 'gambar' => 'galeri-4.jpg'],
            ['judul' => 'Supporter SMKN 4 BOGOR', 'tanggal' => '2024-05-15', 'gambar' => 'galeri-3.jpg'],
            ['judul' => 'Upacara', 'tanggal' => '2024-05-10', 'gambar' => 'galeri-2.jpg'],
            ['judul' => 'Pendidikan Karakter', 'tanggal' => '2024-05-05', 'gambar' => 'galeri-6.jpg'],
            ['judul' => 'Pramuka Penggalang', 'tanggal' => '2024-04-28', 'gambar' => 'galeri-5.jpg'],
            ['judul' => 'Peringatan Hari Kartini', 'tanggal' => '2024-04-21', 'gambar' => 'galeri-7.jpg'],
            ['judul' => 'Kunjungan Industri', 'tanggal' => '2024-04-12', 'gambar' => 'galeri-3.jpg'],
            ['judul' => 'Class Meeting', 'tanggal' => '2024-04-03', 'gambar' => 'galeri-1.jpg'],
            ['judul' => 'Lomba Kebersihan Kelas', 'tanggal' => '2024-03-20', 'gambar' => 'galeri-6.jpg'],
            ['judul' => 'Bakti Sosial OSIS', 'tanggal' => '2024-03-08', 'gambar' => 'galeri-7.jpg'],
            ['judul' => 'Pelepasan Siswa Kelas XII', 'tanggal' => '2024-03-01', 'gambar' => 'galeri-5.jpg'],
        ])->map(fn ($g) => (object) $g);

        $cari = trim((string) $request->query('q'));

        $terfilter = $semua
            ->when($cari, fn ($c) => $c->filter(fn ($g) => str_contains(strtolower($g->judul), strtolower($cari))))
            ->values();

        $perHalaman = 5;
        $halaman = LengthAwarePaginator::resolveCurrentPage();

        $galeris = new LengthAwarePaginator(
            $terfilter->forPage($halaman, $perHalaman)->values(),
            $terfilter->count(),
            $perHalaman,
            $halaman,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.galeri.index', [
            'galeris' => $galeris,
            'cari' => $cari,
        ]);
    }
}