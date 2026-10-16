@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@section('content')

<section class="page-hero">
    <h1>Profil Perusahaan</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fa-solid fa-angle-right"></i>
        <span>Profil Perusahaan</span>
    </nav>
</section>

<div class="page-bg">
    <div class="container profile-body">

        <article class="sambutan-card">
            <img src="{{ asset('images/about.jpg') }}" alt="{{ $profil->nama_perusahaan }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}'">
            <div class="sambutan-text">
                <h2>Tentang Kami</h2>
                <blockquote>{{ $profil->tentang }}</blockquote>
                <div class="nama">{{ $profil->nama_perusahaan }}</div>
                <div class="jabatan">Solusi Teknologi Informasi &amp; Jaringan</div>
            </div>
        </article>

        <section class="sejarah">
            <div>
                <span class="eyebrow-line">Identity &amp; Heritage</span>
                <h2>Sejarah Perusahaan</h2>
                @foreach (preg_split('/\R{2,}/', trim($profil->sejarah)) as $paragraf)
                    <p>{{ $paragraf }}</p>
                @endforeach
            </div>
            <div class="sejarah-img">
                <img src="{{ asset('images/sejarah.jpg') }}" alt="Sejarah {{ $profil->nama_perusahaan }}"
                     onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}'">
            </div>
        </section>

        <section class="visi-misi">
            <div class="vm-card visi">
                <div class="vm-icon"><i class="fa-regular fa-eye"></i></div>
                <h3>Visi</h3>
                <p>{{ $profil->visi }}</p>
            </div>
            <div class="vm-card misi">
                <div class="vm-icon"><i class="fa-regular fa-clipboard"></i></div>
                <h3>Misi</h3>
                <ul style="padding-left:18px;margin:0;">
                    @foreach (preg_split('/\R/', trim($profil->misi)) as $m)
                        @if (trim($m) !== '')<li>{{ $m }}</li>@endif
                    @endforeach
                </ul>
            </div>
        </section>

    </div>
</div>

@endsection