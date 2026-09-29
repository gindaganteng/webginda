@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

<section class="page-hero left below sm">
    <div class="container">
        <h1>Kontak</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>Kontak</span>
        </nav>
    </div>
</section>

<div class="page-bg">
    <div class="container kontak-wrap">

        {{-- PETA --}}
        <div class="peta">
            <iframe
                src="https://www.google.com/maps?q=SMK+Negeri+4+Bogor&output=embed"
                title="Lokasi SMK Negeri 4 Bogor" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        {{-- INFO + FORM --}}
        <div class="kontak-grid">
            <div class="kontak-info">
                <h2>Hubungi Kami</h2>
                <p>Kami selalu siap membantu dan mendengarkan aspirasi Anda. Silakan hubungi kami melalui kanal informasi di bawah ini atau kunjungi sekolah kami secara langsung.</p>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div><h3>Alamat</h3><p>Jl. Raya Tajur Kp. Buntar, Muarasari, Bogor Selatan, Kota Bogor</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div><h3>Telepon</h3><p>+62 821 226 2442</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-regular fa-envelope"></i></div>
                    <div><h3>Email</h3><p>info@smkn4bogor.sch.id</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
                    <div>
                        <h3>Jam Operasional</h3>
                        <p>Senin - Jumat: 07.00 - 16.00 WIB<br>Sabtu: 07.00 - 13.00 WIB<br>Minggu: Tutup</p>
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
            <img src="{{ asset('images/gedung-sekolah.jpg') }}" alt="Gedung SMK Negeri 4 Bogor">
            <div class="banner-teks">
                <h2>Mari Berkolaborasi</h2>
                <p>Kami menyambut baik setiap kolaborasi dari orang tua, alumni, dan institusi pendidikan untuk memajukan generasi masa depan.</p>
            </div>
        </section>

    </div>
</div>

@endsection