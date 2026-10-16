<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;
use App\Models\Profil;
use Illuminate\Http\Request;

class PublikController extends Controller
{
    private function profil(): Profil
    {
        return Profil::first() ?? new Profil([
            'nama_perusahaan' => 'PT Solusi Koneksi Anda',
            'tentang' => '', 'sejarah' => '', 'visi' => '', 'misi' => '',
            'alamat' => '-', 'telepon' => '-', 'email' => '-', 'jam_kerja' => '-',
        ]);
    }

    public function home()
    {
        return view('welcome', [
            'profil'  => $this->profil(),
            'produks' => Produk::latest()->take(3)->get(),
            'artikels' => Artikel::orderByDesc('tanggal')->take(3)->get(),
            'jmlProduk'  => Produk::count(),
            'jmlArtikel' => Artikel::count(),
            'jmlGaleri'  => Galeri::count(),
        ]);
    }

    public function profilPage()
    {
        return view('profil', ['profil' => $this->profil()]);
    }

    public function produk(Request $request)
    {
        $kategoriAktif = $request->query('kategori');
        $cari = trim((string) $request->query('q'));

        $daftar = Produk::query()
            ->when($kategoriAktif, fn ($q) => $q->where('kategori', $kategoriAktif))
            ->when($cari, fn ($q) => $q->where('nama', 'like', "%{$cari}%"))
            ->latest()
            ->get();

        return view('produk', [
            'daftar' => $daftar,
            'kategoriList' => Produk::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'),
            'kategoriAktif' => $kategoriAktif,
            'cari' => $cari,
        ]);
    }

    public function artikel(Request $request)
    {
        $kategoriAktif = $request->query('kategori');
        $cari = trim((string) $request->query('q'));

        $daftar = Artikel::query()
            ->when($kategoriAktif, fn ($q) => $q->where('kategori', $kategoriAktif))
            ->when($cari, fn ($q) => $q->where(function ($w) use ($cari) {
                $w->where('judul', 'like', "%{$cari}%")
                  ->orWhere('deskripsi', 'like', "%{$cari}%");
            }))
            ->orderByDesc('tanggal')
            ->get();

        return view('artikel', [
            'daftar' => $daftar,
            'kategoriList' => Artikel::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'),
            'kategoriAktif' => $kategoriAktif,
            'cari' => $cari,
        ]);
    }

    public function galeri()
    {
        return view('galeri', ['foto' => Galeri::orderByDesc('tanggal')->get()]);
    }

    public function kontak()
    {
        return view('kontak', ['profil' => $this->profil()]);
    }
}