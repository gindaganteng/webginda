@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

@php
    $kategoriAktif = request('kategori');

    // Data contoh. 'rasio' = lebar / tinggi foto (perkiraan), dipakai untuk menyusun baris.
    // Sesuaikan kategori & keterangan dengan foto aslinya, atau ganti dengan data database.
    $foto = collect([
        ['file' => 'galeri-1.jpg', 'kategori' => 'Event',           'alt' => 'Pertunjukan tari tradisional',  'rasio' => 1.65],
        ['file' => 'galeri-2.jpg', 'kategori' => 'Akademik',        'alt' => 'Upacara bendera',               'rasio' => 1.75],
        ['file' => 'galeri-3.jpg', 'kategori' => 'Event',           'alt' => 'Kegiatan di aula olahraga',     'rasio' => 1.75],
        ['file' => 'galeri-4.jpg', 'kategori' => 'Event',           'alt' => 'Kegiatan kurban',               'rasio' => 1.55],
        ['file' => 'galeri-5.jpg', 'kategori' => 'Ekstrakurikuler', 'alt' => 'Barisan siswa berseragam hitam','rasio' => 1.30],
        ['file' => 'galeri-6.jpg', 'kategori' => 'Ekstrakurikuler', 'alt' => 'Siswa bersama petugas',        'rasio' => 1.05],
        ['file' => 'galeri-7.jpg', 'kategori' => 'Akademik',        'alt' => 'Siswa berdoa bersama',          'rasio' => 1.25],
    ])->map(fn ($f) => (object) $f)
      ->when($kategoriAktif, fn ($c) => $c->where('kategori', $kategoriAktif));
@endphp

<section class="galeri-hero">
    <h1 class="sr-only">Galeri Kegiatan SMKN 4 Kota Bogor</h1>
    <p>Mendokumentasikan momen-momen berharga,<br>SMK NEGERI 4 KOTA BOGOR</p>
</section>

<div class="page-bg">
    <div class="container galeri-wrap">

        <div class="filter-pills" role="group" aria-label="Filter kategori galeri">
            <a href="{{ route('galeri') }}" class="{{ !$kategoriAktif ? 'active' : '' }}">Semua</a>
            @foreach (['Akademik', 'Ekstrakurikuler', 'Event'] as $k)
                <a href="{{ route('galeri', ['kategori' => $k]) }}" class="{{ $kategoriAktif === $k ? 'active' : '' }}">{{ $k }}</a>
            @endforeach
        </div>

        <div class="galeri-grid">
            @forelse ($foto as $f)
                <figure class="galeri-item" style="--r: {{ $f->rasio }}">
                    <img src="{{ asset('images/' . $f->file) }}" alt="{{ $f->alt }}" loading="lazy">
                </figure>
            @empty
                <p class="artikel-kosong">Belum ada foto di kategori ini.</p>
            @endforelse
        </div>

    </div>
</div>

@endsection