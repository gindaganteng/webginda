@extends('layouts.app')

@section('title', 'Artikel Sekolah')

@section('content')

@php
    $kategoriAktif = request('kategori');
    $cari = trim((string) request('q'));

    // Data contoh. Nanti ganti dengan data dari database (model Artikel).
    $daftar = collect([
        ['kategori' => 'Kegiatan Sekolah', 'tanggal' => '2 JULI 2026',  'judul' => 'Kegiatan MPLS Tahun 2026',
         'ringkas' => 'Masa Pengenalan Lingkungan Sekolah (MPLS) tahun ini berjalan dengan lancar dan penuh semangat....', 'gambar' => 'artikel-1.jpg'],
        ['kategori' => 'Prestasi',         'tanggal' => '18 Mei 2025',  'judul' => 'Siswa Berprestasi di Pramuka',
         'ringkas' => 'Prestasi membanggakan kembali diukir oleh siswa SMKN 4 KOTA BOGOR tim sekolah berhasil membawa pulang tiga medali emas sekaligus, membuktikan kualitas...', 'gambar' => 'artikel-2.jpg'],
        ['kategori' => 'Pengumuman',       'tanggal' => '10 Mei 2025',  'judul' => 'Kelulusan Tahun 2025',
         'ringkas' => 'Selamat kepada seluruh siswa kelas 12 SMKN 4 KOTA BOGOR atas kelulusan 100% tahun ini.', 'gambar' => 'artikel-3.jpg'],
    ])->map(fn ($a) => (object) $a)
      ->when($kategoriAktif, fn ($c) => $c->where('kategori', $kategoriAktif))
      ->when($cari, fn ($c) => $c->filter(fn ($a) => str_contains(strtolower($a->judul . ' ' . $a->ringkas), strtolower($cari))));
@endphp

<section class="page-hero left">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Artikel</span>
        </nav>
        <h1>Artikel Sekolah</h1>
        <p class="page-hero-sub">Ikuti perkembangan terbaru, prestasi siswa, dan berbagai kegiatan edukatif yang berlangsung di lingkungan SMKN 4 KOTA BOGOR</p>
    </div>
</section>

<div class="page-bg">
    <div class="container artikel-layout">

        {{-- SIDEBAR --}}
        <aside>
            <div class="side-card">
                <label for="cari" class="side-label">Cari Artikel</label>
                <form method="GET" action="{{ route('artikel') }}" class="search-box">
                    @if ($kategoriAktif)<input type="hidden" name="kategori" value="{{ $kategoriAktif }}">@endif
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" id="cari" name="q" value="{{ $cari }}" placeholder="Masukkan kata kunci...">
                </form>
            </div>

            <div class="side-card">
                <h3 class="side-title">Kategori</h3>
                <ul class="kategori-list">
                    <li><a href="{{ route('artikel') }}" class="{{ !$kategoriAktif ? 'active' : '' }}">Semua</a></li>
                    @foreach (['Kegiatan Sekolah', 'Prestasi', 'Pengumuman'] as $k)
                        <li><a href="{{ route('artikel', ['kategori' => $k]) }}" class="{{ $kategoriAktif === $k ? 'active' : '' }}">{{ $k }}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- DAFTAR ARTIKEL --}}
        <div class="artikel-list">
            @forelse ($daftar as $a)
                <article class="artikel-item">
                    <img src="{{ asset('images/' . $a->gambar) }}" alt="{{ $a->judul }}">
                    <div class="artikel-content">
                        <div class="artikel-meta">
                            <span class="pill">{{ $a->kategori }}</span>
                            <span class="tgl"><i class="fa-regular fa-calendar"></i> {{ $a->tanggal }}</span>
                        </div>
                        <h2>{{ $a->judul }}</h2>
                        <p>{{ $a->ringkas }}</p>
                        <a href="#" class="read-lg">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            @empty
                <div class="artikel-kosong">Artikel tidak ditemukan.</div>
            @endforelse
        </div>

    </div>
</div>

@endsection