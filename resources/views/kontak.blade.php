@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')

<section class="page-hero left below sm">
    <div class="container">
        <h1>Kontak Kami</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Kontak Kami</span>
        </nav>
    </div>
</section>

<div class="page-bg">
    <div class="container kontak-wrap">

        {{-- PETA --}}
        <div class="peta">
            <iframe
                src="https://www.google.com/maps?q={{ urlencode($profil->alamat) }}&output=embed"
                title="Lokasi {{ $profil->nama_perusahaan }}" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        {{-- INFO + FORM --}}
        <div class="kontak-grid">
            <div class="kontak-info">
                <h2>Hubungi Kami</h2>
                <p>Kami siap membantu kebutuhan teknologi dan jaringan Anda. Silakan hubungi kami melalui kanal di bawah ini atau kunjungi kantor kami secara langsung.</p>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div><h3>Alamat</h3><p>{{ $profil->alamat }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div><h3>Telepon</h3><p>{{ $profil->telepon }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-regular fa-envelope"></i></div>
                    <div><h3>Email</h3><p>{{ $profil->email }}</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
                    <div>
                        <h3>Jam Operasional</h3>
                        <p>{{ $profil->jam_kerja }}</p>
                    </div>
                </div>
            </div>

            <div class="form-card" id="kirim-pesan">
                <h2>Kirim Pesan</h2>

                @if (session('sukses'))
                    <div class="alert-sukses" role="status">{{ session('sukses') }}</div>
                @endif

                <form method="POST" action="{{ route('kontak.kirim') }}" novalidate>
                    @csrf
                    <div class="field">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda" required>
                        @error('nama')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="alamat@email.com" required>
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" name="pesan" placeholder="Tuliskan pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                        @error('pesan')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-kirim">Kirim Pesan <i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>

        {{-- BANNER --}}
        <section class="banner-kolab">
            <img src="{{ asset('images/about.jpg') }}" alt="Kantor {{ $profil->nama_perusahaan }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}'">
            <div class="banner-teks">
                <h2>Mari Berkolaborasi</h2>
                <p>Kami menyambut baik kerja sama dengan mitra, klien, dan institusi untuk menghadirkan solusi teknologi yang andal.</p>
            </div>
        </section>

    </div>
</div>

@endsection