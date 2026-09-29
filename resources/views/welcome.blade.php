@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section class="hero-section">
    <div class="hero-bg">
        <img src="{{ asset('images/lapsmkn4.jpg') }}" alt="SMK Negeri 4 Bogor">
    </div>
    <div class="hero-overlay">
        <span class="eyebrow">UNGGUL DALAM PRESTASI</span>
        <h1>SMK NEGERI 4 BOGOR</h1>
        <p>Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan keahlian. Siap kerja, santun, mandiri, dan kreatif.</p>
        <a href="{{ route('profil') }}" class="btn-hero">Jelajahi Sekolah <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</section>

<div class="stats-wrapper">
    <div class="stats-container">
        <div class="stat-card">
            <i class="fa-solid fa-users stat-icon"></i>
            <div class="stat-number">1125</div>
            <div class="stat-label">SISWA AKTIF</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-lightbulb stat-icon"></i>
            <div class="stat-number">60</div>
            <div class="stat-label">TENAGA PENDIDIK</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-rocket stat-icon"></i>
            <div class="stat-number">4</div>
            <div class="stat-label">PROGRAM KEAHLIAN</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-trophy stat-icon"></i>
            <div class="stat-number">100%</div>
            <div class="stat-label">KELULUSAN 2025</div>
        </div>
    </div>
</div>

{{-- SAMBUTAN --}}
<section class="section">
    <div class="container about">
        <div class="thumb"><img src="{{ asset('images/kepala-sekolah.jpg') }}" alt="Kepala Sekolah"></div>
        <div>
            <h2>Sambutan Kepala Sekolah</h2>
            <p>Selamat datang di website resmi SMKN 4 Kota Bogor. Kami berkomitmen menghadirkan pendidikan kejuruan yang berkualitas, dekat dengan dunia usaha, dan menumbuhkan karakter siswa.</p>
            <p>Melalui website ini, Anda dapat mengikuti kegiatan, prestasi, dan produk hasil karya siswa kami.</p>
            <a href="{{ route('profil') }}" class="link-more">Baca selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

{{-- ARTIKEL --}}
@php
    // Ganti dengan data dari controller: Artikel::latest()->take(3)->get()
    $artikels = $artikels ?? collect([
        ['id'=>1,'kategori'=>'Kegiatan Sekolah','tanggal'=>'2 Juli 2026','judul'=>'Kegiatan MPLS Tahun 2026','ringkas'=>'Masa Pengenalan Lingkungan Sekolah (MPLS) tahun ini berjalan dengan lancar dan penuh semangat.','gambar'=>'artikel-1.jpg'],
        ['id'=>2,'kategori'=>'Prestasi','tanggal'=>'18 Mei 2025','judul'=>'Siswa Berprestasi di Pramuka','ringkas'=>'Tim sekolah berhasil membawa pulang tiga medali emas sekaligus, membuktikan kualitas siswa.','gambar'=>'artikel-2.jpg'],
        ['id'=>3,'kategori'=>'Pengumuman','tanggal'=>'10 Mei 2025','judul'=>'Kelulusan Tahun 2025','ringkas'=>'Selamat kepada seluruh siswa kelas 12 SMKN 4 Kota Bogor atas kelulusan 100% tahun ini.','gambar'=>'artikel-3.jpg'],
    ])->map(fn ($a) => (object) $a);
@endphp

<section class="section soft">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Artikel Terbaru</h2>
                <p>Ikuti perkembangan terbaru, prestasi siswa, dan berbagai kegiatan edukatif.</p>
            </div>
            <a href="{{ route('artikel') }}" class="link-more">Semua artikel <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="grid-3">
            @foreach ($artikels as $a)
            <article class="card article">
                <div class="thumb"><img src="{{ asset('images/' . $a->gambar) }}" alt="{{ $a->judul }}"></div>
                <div class="article-body">
                    <div class="meta"><span class="pill">{{ $a->kategori }}</span><span>{{ $a->tanggal }}</span></div>
                    <h3>{{ $a->judul }}</h3>
                    <p>{{ $a->ringkas }}</p>
                    <a href="{{ route('artikel') }}" class="read">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection