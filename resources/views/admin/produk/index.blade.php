@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('header_custom')
<header class="page-head sm">
    <div>
        <h1>Kelola Produk</h1>
        <p>Manajemen katalog seragam dan atribut sekolah</p>
    </div>
    <a href="#" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Produk</a>
</header>
@endsection

@section('content')

<div class="info-row">
    <div class="info-card plain">
        <span class="info-ico biru"><i class="fa-solid fa-box-archive"></i></span>
        <div><small>Total SKU</small><strong>100 Produk</strong></div>
    </div>
    <div class="info-card plain">
        <span class="info-ico kuning"><i class="fa-solid fa-money-bill-wave"></i></span>
        <div><small>Update Terakhir</small><strong>12 Agustus 2026</strong></div>
    </div>
    <div class="info-card plain">
        <span class="info-ico peach"><i class="fa-solid fa-cart-shopping"></i></span>
        <div><small>Pesanan Aktif</small><strong>8 Baru</strong></div>
    </div>
</div>

<section class="produk-panel">
    <div class="panel-top">
        <h2>Daftar Produk</h2>
        <form method="GET" action="{{ route('admin.produk') }}" class="panel-search">
            <div class="mini-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" value="{{ $cari }}" placeholder="Cari produk..." aria-label="Cari produk">
            </div>
            <button type="submit" class="btn-ikon" aria-label="Terapkan pencarian"><i class="fa-solid fa-filter"></i></button>
        </form>
    </div>

    <div class="tabel-scroll">
        <table class="tabel-produk">
            <thead>
                <tr>
                    <th class="t-no">No</th>
                    <th>Foto</th>
                    <th class="t-nama">Nama Produk</th>
                    <th>Harga</th>
                    <th class="t-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $i => $p)
                    <tr>
                        <td class="t-no">{{ $i + 1 }}</td>
                        <td><img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama }}" class="thumb-produk"></td>
                        <td class="t-nama">
                            <a href="#" class="nama-produk">{{ $p->nama }}</a>
                            <small>Kategori: {{ $p->kategori }}</small>
                        </td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td class="t-aksi">
                            <a href="#" class="edit" aria-label="Edit {{ $p->nama }}"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="hapus" aria-label="Hapus {{ $p->nama }}"><i class="fa-regular fa-trash-can"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="kosong">Produk tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection

@section('footer_custom')
<footer class="admin-foot split">
    <span>&copy; {{ date('Y') }} SMKN 4 KOTA BOGOR Terakhir diperbarui: 12 Agustus 2026</span>
    <nav>
        <a href="#">Panduan Admin</a>
        <a href="#">Bantuan Teknis</a>
    </nav>
</footer>
@endsection