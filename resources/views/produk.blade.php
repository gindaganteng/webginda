@extends('layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

<section class="page-hero left below">
    <div class="container">
        <h1>Produk / Layanan</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Produk / Layanan</span>
        </nav>
    </div>
</section>

<div class="page-bg">
    <div class="container produk-wrap">

        <div class="produk-toolbar">
            <div class="chips" role="group" aria-label="Filter kategori">
                <a href="{{ route('produk') }}" class="chip {{ !$kategoriAktif ? 'active' : '' }}">Semua</a>
                @foreach ($kategoriList as $k)
                    <a href="{{ route('produk', ['kategori' => $k]) }}" class="chip {{ $kategoriAktif === $k ? 'active' : '' }}">{{ $k }}</a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('produk') }}" class="search-box produk-search">
                @if ($kategoriAktif)<input type="hidden" name="kategori" value="{{ $kategoriAktif }}">@endif
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" value="{{ $cari }}" placeholder="Cari produk / layanan..." aria-label="Cari">
            </form>
        </div>

        <div class="produk-grid">
            @forelse ($daftar as $p)
                <article class="produk-card">
                    <div class="produk-img"><img src="{{ $p->gambar_url }}" alt="{{ $p->nama }}"></div>
                    <div class="produk-body">
                        <span class="produk-label">{{ $p->kategori }}</span>
                        <h2>{{ $p->nama }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit($p->deskripsi, 90) }}</p>
                        @if ($p->harga)
                            <div class="produk-harga">Mulai Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        @endif
                        <a href="{{ route('kontak') }}" class="btn-detail">Hubungi Kami</a>
                    </div>
                </article>
            @empty
                <p class="artikel-kosong">Produk / layanan tidak ditemukan.</p>
            @endforelse
        </div>

    </div>
</div>

@endsection