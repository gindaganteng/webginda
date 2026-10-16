@extends('layouts.app')

@section('title', 'Artikel / Informasi Terkini')

@section('content')

<section class="page-hero left">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Artikel</span>
        </nav>
        <h1>Artikel / Informasi Terkini</h1>
        <p class="page-hero-sub">Kabar, tips, dan pengumuman terbaru seputar layanan {{ config('app.name') }}.</p>
    </div>
</section>

<div class="page-bg">
    <div class="container artikel-layout">

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
                    @foreach ($kategoriList as $k)
                        <li><a href="{{ route('artikel', ['kategori' => $k]) }}" class="{{ $kategoriAktif === $k ? 'active' : '' }}">{{ $k }}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <div class="artikel-list">
            @forelse ($daftar as $a)
                <article class="artikel-item">
                    <img src="{{ $a->gambar_url }}" alt="{{ $a->judul }}">
                    <div class="artikel-content">
                        <div class="artikel-meta">
                            <span class="pill">{{ $a->kategori }}</span>
                            <span class="tgl"><i class="fa-regular fa-calendar"></i> {{ $a->tanggal->locale('id')->translatedFormat('d F Y') }}</span>
                        </div>
                        <h2>{{ $a->judul }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit($a->deskripsi, 220) }}</p>
                    </div>
                </article>
            @empty
                <div class="artikel-kosong">Artikel tidak ditemukan.</div>
            @endforelse
        </div>

    </div>
</div>

@endsection