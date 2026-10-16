@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard Overview')
@section('subheading', 'Selamat datang kembali, Admin.')

@section('content')

@php
    $statistik = [
        ['kelas' => 'kuning', 'ikon' => 'fa-solid fa-file-lines',   'badge' => 'Total', 'angka' => $jmlArtikel, 'label' => 'Artikel / Informasi'],
        ['kelas' => 'biru',   'ikon' => 'fa-solid fa-bag-shopping', 'badge' => 'Total', 'angka' => $jmlProduk,  'label' => 'Produk / Layanan'],
        ['kelas' => 'abu',    'ikon' => 'fa-regular fa-image',      'badge' => 'Total', 'angka' => $jmlGaleri,  'label' => 'Foto Galeri'],
        ['kelas' => 'gelap',  'ikon' => 'fa-regular fa-building',   'badge' => 'Statis', 'angka' => 1,          'label' => 'Profil Perusahaan'],
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

    <section class="panel">
        <h2>Aksi Cepat</h2>
        <div class="quick">
            <a href="{{ route('admin.artikel.tambah') }}"><i class="fa-regular fa-newspaper"></i> Tambah Artikel</a>
            <a href="{{ route('admin.produk.tambah') }}"><i class="fa-solid fa-bag-shopping"></i> Tambah Produk / Layanan</a>
            <a href="{{ route('admin.galeri.tambah') }}"><i class="fa-regular fa-images"></i> Tambah Foto Galeri</a>
            <a href="{{ route('admin.profil') }}"><i class="fa-regular fa-building"></i> Edit Profil Perusahaan</a>
        </div>
    </section>

    <section class="panel aktivitas">
        <h2>Aktivitas Terbaru</h2>
        <ul>
            @forelse ($aktivitas as $a)
                <li>
                    <span class="dot {{ $a['warna'] }}"></span>
                    <div>
                        <strong>{{ $a['judul'] }}</strong>
                        <p>{{ $a['isi'] }}</p>
                        <small>{{ $a['waktu']->locale('id')->diffForHumans() }}</small>
                    </div>
                </li>
            @empty
                <li><div><p>Belum ada aktivitas.</p></div></li>
            @endforelse
        </ul>
    </section>

</div>

@endsection