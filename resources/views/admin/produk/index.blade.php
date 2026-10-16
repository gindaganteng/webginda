@extends('layouts.admin')

@section('title', 'Kelola Produk / Layanan')

@section('header_custom')
<header class="page-head sm">
    <div>
        <h1>Kelola Produk / Layanan</h1>
        <p>Manajemen daftar produk dan layanan perusahaan</p>
    </div>
    <a href="{{ route('admin.produk.tambah') }}" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Produk / Layanan</a>
</header>
@endsection

@section('content')

@if (session('sukses'))
    <div class="alert-sukses" role="status">{{ session('sukses') }}</div>
@endif

<div class="info-row">
    <div class="info-card plain">
        <span class="info-ico biru"><i class="fa-solid fa-box-archive"></i></span>
        <div><small>Total Produk / Layanan</small><strong>{{ $produks->count() }}</strong></div>
    </div>
    <div class="info-card plain">
        <span class="info-ico kuning"><i class="fa-regular fa-clock"></i></span>
        <div><small>Terakhir Ditambahkan</small><strong>{{ $terbaru->nama ?? '-' }}</strong></div>
    </div>
</div>

<section class="produk-panel">
    <div class="panel-top">
        <h2>Daftar Produk / Layanan</h2>
        <form method="GET" action="{{ route('admin.produk') }}" class="panel-search">
            <div class="mini-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" value="{{ $cari }}" placeholder="Cari..." aria-label="Cari produk">
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
                    <th class="t-nama">Nama</th>
                    <th>Harga</th>
                    <th class="t-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $i => $p)
                    <tr>
                        <td class="t-no">{{ $i + 1 }}</td>
                        <td><img src="{{ $p->gambar_url }}" alt="{{ $p->nama }}" class="thumb-produk"></td>
                        <td class="t-nama">
                            <a href="{{ route('admin.produk.edit', $p) }}" class="nama-produk">{{ $p->nama }}</a>
                            <small>Kategori: {{ $p->kategori }}</small>
                        </td>
                        <td>{{ $p->harga ? 'Rp ' . number_format($p->harga, 0, ',', '.') : '-' }}</td>
                        <td class="t-aksi">
                            <a href="{{ route('admin.produk.edit', $p) }}" class="edit" aria-label="Edit {{ $p->nama }}"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.produk.hapus', $p) }}" onsubmit="return confirm('Hapus produk / layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hapus" aria-label="Hapus {{ $p->nama }}"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="kosong">Produk / layanan tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection