@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard Overview')
@section('subheading', 'Selamat datang kembali, Admin.')

@section('content')

@php
    // Data contoh. Nanti ganti dengan hitungan dari database, mis. Artikel::count().
    $statistik = [
        ['kelas' => 'kuning', 'ikon' => 'fa-solid fa-file-lines',       'badge' => '+2 baru',   'angka' => 4,       'label' => 'Total Artikel'],
        ['kelas' => 'biru',   'ikon' => 'fa-solid fa-bag-shopping',     'badge' => 'Stok aman', 'angka' => 2,       'label' => 'Produk Sekolah'],
        ['kelas' => 'abu',    'ikon' => 'fa-regular fa-image',          'badge' => '24 Album',  'angka' => 7,       'label' => 'Foto Galeri'],
        ['kelas' => 'gelap',  'ikon' => 'fa-solid fa-arrow-trend-up',   'badge' => '+12%',      'angka' => '1.250', 'label' => 'Pengunjung'],
    ];

    $aktivitas = [
        ['warna' => 'navy',  'judul' => 'Artikel Baru Dipublikasikan', 'isi' => 'Artikel "Kegiatan MPLS Tahun 2024" baru saja tayang.', 'waktu' => '2 jam yang lalu'],
        ['warna' => 'emas',  'judul' => 'Update Produk',               'isi' => 'Stok "Aksesoris" telah diperbarui.',                   'waktu' => '5 jam yang lalu'],
        ['warna' => 'navy',  'judul' => 'Galeri Foto',                 'isi' => '5 foto baru ditambahkan ke album "Nebrazka".',        'waktu' => 'Kemarin, 14:20'],
    ];
@endphp

<div class="stat-grid">
    @foreach ($statistik as $s)
        <div class="stat-box {{ $s['kelas'] }}">
            <div class="stat-top">
                <span class="stat-ico"><i class="{{ $s['ikon'] }}"></i></span>
                <span class="stat-badge">{{ $s['badge'] }}</span>
            </div>
            <div class="stat-num">{{ $s['angka'] }}</div>
            <div class="stat-lbl">{{ $s['label'] }}</div>
        </div>
    @endforeach
</div>

<div class="dash-grid">

    {{-- Aksi cepat (tambahan, tidak ada di Figma; hapus blok ini kalau tidak perlu) --}}
    <section class="panel">
        <h2>Aksi Cepat</h2>
        <div class="quick">
            <a href="#"><i class="fa-regular fa-newspaper"></i> Tambah Artikel</a>
            <a href="#"><i class="fa-solid fa-bag-shopping"></i> Tambah Produk</a>
            <a href="#"><i class="fa-regular fa-images"></i> Tambah Foto Galeri</a>
        </div>
    </section>

    {{-- Aktivitas terbaru --}}
    <section class="panel aktivitas">
        <h2>Aktivitas Terbaru</h2>
        <ul>
            @foreach ($aktivitas as $a)
                <li>
                    <span class="dot {{ $a['warna'] }}"></span>
                    <div>
                        <strong>{{ $a['judul'] }}</strong>
                        <p>{{ $a['isi'] }}</p>
                        <small>{{ $a['waktu'] }}</small>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="#" class="btn-outline-full">Lihat Semua Aktivitas</a>
    </section>

</div>

@endsection