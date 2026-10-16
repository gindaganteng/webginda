@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')

@php $rasio = [1.65, 1.3, 1.75, 1.1]; @endphp

<section class="galeri-hero">
    <h1 class="sr-only">Galeri Kegiatan {{ config('app.name') }}</h1>
    <p>Dokumentasi kegiatan dan momen berharga,<br>{{ strtoupper(config('app.name')) }}</p>
</section>

<div class="page-bg">
    <div class="container galeri-wrap">
        <div class="galeri-grid">
            @forelse ($foto as $f)
                <figure class="galeri-item" style="--r: {{ $rasio[$loop->index % 4] }}">
                    <img src="{{ $f->gambar_url }}" alt="{{ $f->judul }}" title="{{ $f->judul }}" loading="lazy">
                </figure>
            @empty
                <p class="artikel-kosong">Belum ada foto kegiatan.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection