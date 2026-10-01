@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('header_custom')
<header class="page-head">
    <div>
        <h1>Manajemen Artikel</h1>
        <p>Kelola publikasi berita dan pengumuman sekolah</p>
    </div>
    <a href="#" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Artikel</a>
</header>
@endsection

@section('content')

<form method="GET" action="{{ route('admin.artikel') }}" class="filter-bar">
    <div class="filter-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" name="q" value="{{ $cari }}" placeholder="Cari judul artikel..." aria-label="Cari judul artikel">
    </div>
    <div class="filter-right">
        <select name="kategori" aria-label="Kategori">
            <option value="">Semua Kategori</option>
            @foreach ($kategoriList as $k)
                <option value="{{ $k }}" @selected($kategori === $k)>{{ $k }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-filter">Filter</button>
    </div>
</form>

<div class="tabel-card">
    <div class="tabel-scroll">
        <table class="tabel">
            <thead>
                <tr>
                    <th class="c-no">No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th class="c-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artikels as $i => $a)
                    <tr>
                        <td>{{ $artikels->firstItem() + $i }}</td>
                        <td>
                            <div class="judul-cell">
                                <img src="{{ asset('images/' . $a->gambar) }}" alt="">
                                <a href="#">{{ $a->judul }}</a>
                            </div>
                        </td>
                        <td><span class="badge-kat {{ Str::slug($a->kategori) }}">{{ $a->kategori }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td class="aksi">
                            <a href="#" class="edit" aria-label="Edit {{ $a->judul }}"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="hapus" aria-label="Hapus {{ $a->judul }}"><i class="fa-regular fa-trash-can"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="kosong">Artikel tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="tabel-foot">
        <span>Menampilkan {{ $artikels->firstItem() ?? 0 }}-{{ $artikels->lastItem() ?? 0 }} dari {{ $artikels->total() }} artikel</span>

        <nav class="pager" aria-label="Halaman">
            @if ($artikels->onFirstPage())
                <span class="pg off"><i class="fa-solid fa-angle-left"></i></span>
            @else
                <a class="pg" href="{{ $artikels->previousPageUrl() }}" aria-label="Sebelumnya"><i class="fa-solid fa-angle-left"></i></a>
            @endif

            @for ($p = 1; $p <= $artikels->lastPage(); $p++)
                <a class="pg {{ $p === $artikels->currentPage() ? 'on' : '' }}" href="{{ $artikels->url($p) }}">{{ $p }}</a>
            @endfor

            @if ($artikels->hasMorePages())
                <a class="pg" href="{{ $artikels->nextPageUrl() }}" aria-label="Berikutnya"><i class="fa-solid fa-angle-right"></i></a>
            @else
                <span class="pg off"><i class="fa-solid fa-angle-right"></i></span>
            @endif
        </nav>
    </div>
</div>

<div class="info-row">
    <div class="info-card">
        <span class="info-ico biru"><i class="fa-regular fa-eye"></i></span>
        <div><small>Total View Artikel</small><strong>23,482</strong></div>
    </div>
    <div class="info-card">
        <span class="info-ico kuning"><i class="fa-regular fa-star"></i></span>
        <div><small>Artikel Populer</small><strong>Kegiatan MPLS 2026</strong></div>
    </div>
    <div class="info-card">
        <span class="info-ico abu"><i class="fa-solid fa-clock-rotate-left"></i></span>
        <div><small>Terakhir Update</small><strong class="gelap">Hari ini, 09:45 WIB</strong></div>
    </div>
</div>

@endsection