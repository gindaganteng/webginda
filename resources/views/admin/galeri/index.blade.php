@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('header_custom')
<header class="page-head">
    <div>
        <h1>Galeri</h1>
        <nav class="crumb" aria-label="Breadcrumb">
            <span>Admin</span>
            <span>/</span>
            <strong>Galeri</strong>
        </nav>
    </div>
    <a href="#" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Galeri</a>
</header>
@endsection

@section('content')

<div class="mini-row">
    <div class="mini-card">
        <span class="info-ico biru"><i class="fa-regular fa-images"></i></span>
        <div><small>Total Foto</small><strong>1,240</strong></div>
    </div>
    <div class="mini-card">
        <span class="info-ico kuning"><i class="fa-solid fa-shapes"></i></span>
        <div><small>Kategori</small><strong>8</strong></div>
    </div>
</div>

<section class="galeri-panel">
    <div class="galeri-top">
        <h2>Daftar Foto Galeri</h2>
        <form method="GET" action="{{ route('admin.galeri') }}" class="search-pill">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="q" value="{{ $cari }}" placeholder="Cari galeri..." aria-label="Cari galeri">
        </form>
    </div>

    <div class="tabel-scroll">
        <table class="tabel-galeri">
            <thead>
                <tr>
                    <th class="g-no">No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th class="g-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeris as $i => $g)
                    <tr>
                        <td class="g-no">{{ $galeris->firstItem() + $i }}</td>
                        <td><img src="{{ asset('images/' . $g->gambar) }}" alt="{{ $g->judul }}" class="thumb-galeri"></td>
                        <td><a href="#" class="judul-galeri">{{ $g->judul }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($g->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td class="g-aksi">
                            <a href="#" class="edit" aria-label="Edit {{ $g->judul }}"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="hapus" aria-label="Hapus {{ $g->judul }}"><i class="fa-regular fa-trash-can"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="kosong">Foto tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="tabel-foot">
        <span>Menampilkan {{ $galeris->firstItem() ?? 0 }}-{{ $galeris->lastItem() ?? 0 }} dari {{ $galeris->total() }} data</span>

        <nav class="pager boxed" aria-label="Halaman">
            @if ($galeris->onFirstPage())
                <span class="pg off"><i class="fa-solid fa-angle-left"></i></span>
            @else
                <a class="pg" href="{{ $galeris->previousPageUrl() }}" aria-label="Sebelumnya"><i class="fa-solid fa-angle-left"></i></a>
            @endif

            @for ($p = 1; $p <= $galeris->lastPage(); $p++)
                <a class="pg {{ $p === $galeris->currentPage() ? 'on' : '' }}" href="{{ $galeris->url($p) }}">{{ $p }}</a>
            @endfor

            @if ($galeris->hasMorePages())
                <a class="pg" href="{{ $galeris->nextPageUrl() }}" aria-label="Berikutnya"><i class="fa-solid fa-angle-right"></i></a>
            @else
                <span class="pg off"><i class="fa-solid fa-angle-right"></i></span>
            @endif
        </nav>
    </div>
</section>

@endsection

@section('footer_custom')
<footer class="admin-foot split">
    <span>&copy; {{ date('Y') }} SMKN 4 Kota Bogor. Semua Hak Dilindungi.</span>
    <nav>
        <a href="#">Help Center</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
    </nav>
</footer>
@endsection