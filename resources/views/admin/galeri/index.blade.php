@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('header_custom')
<header class="page-head">
    <div>
        <h1>Galeri Kegiatan</h1>
        <p>Kelola dokumentasi foto kegiatan perusahaan</p>
    </div>
    <a href="{{ route('admin.galeri.tambah') }}" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Galeri</a>
</header>
@endsection

@section('content')

@if (session('sukses'))
    <div class="alert-sukses" role="status">{{ session('sukses') }}</div>
@endif

<form method="GET" action="{{ route('admin.galeri') }}" class="filter-bar">
    <div class="filter-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" name="q" value="{{ $cari }}" placeholder="Cari judul kegiatan..." aria-label="Cari judul kegiatan">
    </div>
    <div class="filter-right">
        <button type="submit" class="btn-filter">Cari</button>
    </div>
</form>

<div class="tabel-card">
    <div class="tabel-scroll">
        <table class="tabel">
            <thead>
                <tr>
                    <th class="c-no">No</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th class="c-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeris as $i => $g)
                    <tr>
                        <td>{{ $galeris->firstItem() + $i }}</td>
                        <td>
                            <div class="judul-cell">
                                <img src="{{ $g->gambar_url }}" alt="">
                                <a href="{{ route('admin.galeri.edit', $g) }}">{{ $g->judul }}</a>
                            </div>
                        </td>
                        <td>{{ $g->tanggal->locale('id')->translatedFormat('d F Y') }}</td>
                        <td class="aksi">
                            <a href="{{ route('admin.galeri.edit', $g) }}" class="edit" aria-label="Edit {{ $g->judul }}"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.galeri.hapus', $g) }}" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hapus" aria-label="Hapus {{ $g->judul }}"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="kosong">Foto tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="tabel-foot">
        <span>Menampilkan {{ $galeris->firstItem() ?? 0 }}-{{ $galeris->lastItem() ?? 0 }} dari {{ $galeris->total() }} foto</span>

        <nav class="pager" aria-label="Halaman">
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
</div>

@endsection