<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminArtikelController extends Controller
{
    public function index(Request $request)
    {
        $semua = collect([
            ['judul' => 'Kegiatan MPLS Tahun 2026', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2026-05-20', 'gambar' => 'artikel-1.jpg'],
            ['judul' => 'Siswa Berprestasi', 'kategori' => 'Prestasi', 'tanggal' => '2025-05-18', 'gambar' => 'artikel-2.jpg'],
            ['judul' => 'Kunjungan Industri ke Yogyakarta', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2024-07-30', 'gambar' => 'artikel-1.jpg'],
            ['judul' => 'Kelulusan Tahun 2024', 'kategori' => 'Pengumuman', 'tanggal' => '2025-05-10', 'gambar' => 'artikel-3.jpg'],
            ['judul' => 'Juara Lomba LKS Tingkat Kota', 'kategori' => 'Prestasi', 'tanggal' => '2025-04-22', 'gambar' => 'artikel-2.jpg'],
            ['judul' => 'Pengumuman Libur Semester Genap', 'kategori' => 'Pengumuman', 'tanggal' => '2025-04-10', 'gambar' => 'artikel-3.jpg'],
            ['judul' => 'Workshop Kewirausahaan Siswa', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2025-03-15', 'gambar' => 'artikel-1.jpg'],
            ['judul' => 'Bakti Sosial OSIS', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2025-02-27', 'gambar' => 'artikel-1.jpg'],
            ['judul' => 'Peringatan Hari Guru Nasional', 'kategori' => 'Kegiatan Sekolah', 'tanggal' => '2024-11-25', 'gambar' => 'artikel-2.jpg'],
            ['judul' => 'Jadwal Penerimaan Peserta Didik Baru', 'kategori' => 'Pengumuman', 'tanggal' => '2024-06-05', 'gambar' => 'artikel-3.jpg'],
        ])->map(fn ($a) => (object) $a);

        $cari = trim((string) $request->query('q'));
        $kategori = $request->query('kategori');

        $terfilter = $semua
            ->when($cari, fn ($c) => $c->filter(fn ($a) => str_contains(strtolower($a->judul), strtolower($cari))))
            ->when($kategori, fn ($c) => $c->where('kategori', $kategori))
            ->values();

        $perHalaman = 5;
        $halaman = LengthAwarePaginator::resolveCurrentPage();

        $artikels = new LengthAwarePaginator(
            $terfilter->forPage($halaman, $perHalaman)->values(),
            $terfilter->count(),
            $perHalaman,
            $halaman,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.artikel.index', [
            'artikels' => $artikels,
            'kategoriList' => ['Kegiatan Sekolah', 'Prestasi', 'Pengumuman'],
            'cari' => $cari,
            'kategori' => $kategori,
        ]);
    }
}
