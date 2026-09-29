@extends('layouts.app')

@section('title', 'Produk Sekolah')

@section('content')

@php
    $kategoriAktif = request('kategori');
    $cari = trim((string) request('q'));

    // Data contoh. Nanti ganti dengan data dari database (model Produk).
    $daftar = collect([
        ['kategori' => 'Seragam',   'label' => 'Pakaian',   'nama' => 'Seragam Sekolah', 'harga' => 1000000, 'gambar' => 'produk-1.jpg'],
        ['kategori' => 'Aksesoris', 'label' => 'Aksesoris', 'nama' => 'Topi-Dasi',       'harga' => 100000,  'gambar' => 'produk-2.jpg'],
    ])->map(fn ($p) => (object) $p)
      ->when($kategoriAktif, fn ($c) => $c->where('kategori', $kategoriAktif))
      ->when($cari, fn ($c) => $c->filter(fn ($p) => str_contains(strtolower($p->nama), strtolower($cari))));
@endphp

<section class="page-hero left below">
    <div class="container">
        <h1>Produk Sekolah</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Produk</span>
        </nav>
    </div>
</section>

<div class="page-bg">
    <div class="container produk-wrap">

        <div class="produk-toolbar">
            <div class="chips" role="group" aria-label="Filter kategori produk">
                <a href="{{ route('produk') }}" class="chip {{ !$kategoriAktif ? 'active' : '' }}">Semua</a>
                @foreach (['Seragam', 'Aksesoris'] as $k)
                    <a href="{{ route('produk', ['kategori' => $k]) }}" class="chip {{ $kategoriAktif === $k ? 'active' : '' }}">{{ $k }}</a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('produk') }}" class="search-box produk-search">
                @if ($kategoriAktif)<input type="hidden" name="kategori" value="{{ $kategoriAktif }}">@endif
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" value="{{ $cari }}" placeholder="Cari produk..." aria-label="Cari produk">
            </form>
        </div>

        <div class="produk-grid">
            @forelse ($daftar as $p)
                <article class="produk-card">
                    <div class="produk-img"><img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama }}"></div>
                    <div class="produk-body">
                        <span class="produk-label">{{ $p->label }}</span>
                        <h2>{{ $p->nama }}</h2>
                        <div class="produk-harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        <a href="#" class="btn-detail">Lihat Detail</a>
                    </div>
                </article>
            @empty
                <p class="artikel-kosong">Produk tidak ditemukan.</p>
            @endforelse
        </div>

    </div>
</div>

@endsection