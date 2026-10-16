@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section class="hero-section">
    <div class="hero-bg">
        <img src="{{ asset('images/hero.jpg') }}" alt="{{ $profil->nama_perusahaan }}"
             onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}'">
    </div>
    <div class="hero-overlay">
        <span class="eyebrow">SOLUSI TEKNOLOGI TERPERCAYA</span>
        <h1>{{ strtoupper($profil->nama_perusahaan) }}</h1>
        <p>{{ \Illuminate\Support\Str::limit($profil->tentang, 160) }}</p>
        <a href="{{ route('produk') }}" class="btn-hero">Lihat Layanan <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</section>

<div class="stats-wrapper">
    <div class="stats-container">
        <div class="stat-card">
            <i class="fa-solid fa-network-wired stat-icon"></i>
            <div class="stat-number">{{ $jmlProduk }}</div>
            <div class="stat-label">PRODUK / LAYANAN</div>
        </div>
        <div class="stat-card">
            <i class="fa-regular fa-newspaper stat-icon"></i>
            <div class="stat-number">{{ $jmlArtikel }}</div>
            <div class="stat-label">ARTIKEL &amp; INFORMASI</div>
        </div>
        <div class="stat-card">
            <i class="fa-regular fa-images stat-icon"></i>
            <div class="stat-number">{{ $jmlGaleri }}</div>
            <div class="stat-label">DOKUMENTASI KEGIATAN</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-headset stat-icon"></i>
            <div class="stat-number">24/7</div>
            <div class="stat-label">DUKUNGAN TEKNIS</div>
        </div>
    </div>
</div>

{{-- TENTANG --}}
<section class="section">
    <div class="container about">
        <div class="thumb">
            <img src="{{ asset('images/about.jpg') }}" alt="Tentang {{ $profil->nama_perusahaan }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}'">
        </div>
        <div>
            <h2>Tentang Kami</h2>
            <p>{{ $profil->tentang }}</p>
            <p>{{ \Illuminate\Support\Str::limit($profil->visi, 180) }}</p>
            <a href="{{ route('profil') }}" class="link-more">Profil perusahaan <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- LAYANAN --}}
<section class="section soft">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Produk / Layanan Kami</h2>
                <p>Solusi teknologi yang kami siapkan untuk kebutuhan Anda.</p>
            </div>
            <a href="{{ route('produk') }}" class="link-more">Semua layanan <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="produk-grid">
            @forelse ($produks as $p)
                <article class="produk-card">
                    <div class="produk-img"><img src="{{ $p->gambar_url }}" alt="{{ $p->nama }}"></div>
                    <div class="produk-body">
                        <span class="produk-label">{{ $p->kategori }}</span>
                        <h2>{{ $p->nama }}</h2>
                        @if ($p->harga)
                            <div class="produk-harga">Mulai Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        @endif
                        <a href="{{ route('kontak') }}" class="btn-detail">Hubungi Kami</a>
                    </div>
                </article>
            @empty
                <p class="artikel-kosong">Belum ada layanan.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ARTIKEL --}}
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Informasi Terkini</h2>
                <p>Kabar, tips, dan pengumuman terbaru dari kami.</p>
            </div>
            <a href="{{ route('artikel') }}" class="link-more">Semua artikel <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="grid-3">
            @forelse ($artikels as $a)
            <article class="card article">
                <div class="thumb"><img src="{{ $a->gambar_url }}" alt="{{ $a->judul }}"></div>
                <div class="article-body">
                    <div class="meta"><span class="pill">{{ $a->kategori }}</span><span>{{ $a->tanggal->locale('id')->translatedFormat('d F Y') }}</span></div>
                    <h3>{{ $a->judul }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($a->deskripsi, 110) }}</p>
                    <a href="{{ route('artikel') }}" class="read">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            @empty
                <p class="artikel-kosong">Belum ada artikel.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection