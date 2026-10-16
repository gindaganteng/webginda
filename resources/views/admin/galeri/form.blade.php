@extends('layouts.admin')

@section('title', $galeri ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')

@section('header_custom')
<header class="topbar-form">
    <h1>{{ $galeri ? 'Edit Foto Galeri' : 'Tambah Foto Galeri' }}</h1>
</header>
@endsection

@section('content')
<div class="form-wrap">

    <div class="form-head">
        <div>
            <h2>Informasi Kegiatan</h2>
            <p>Unggah foto dokumentasi kegiatan perusahaan.</p>
        </div>
        <nav class="crumb-up" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ route('admin.galeri') }}">Galeri</a>
            <i class="fa-solid fa-angle-right"></i>
            <strong>{{ $galeri ? 'Edit' : 'Baru' }}</strong>
        </nav>
    </div>

    <form method="POST"
          action="{{ $galeri ? route('admin.galeri.update', $galeri) : route('admin.galeri.simpan') }}"
          enctype="multipart/form-data" class="form-card" novalidate>
        @csrf
        @if ($galeri) @method('PUT') @endif

        <div class="fg-row">
            <div class="fg">
                <label for="judul">Judul Kegiatan</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required>
                @error('judul')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="fg">
                <label for="tanggal">Tanggal Kegiatan</label>
                <input type="date" id="tanggal" name="tanggal"
                       value="{{ old('tanggal', optional($galeri->tanggal ?? null)->format('Y-m-d')) }}" required>
                @error('tanggal')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        @include('admin.partials.gambar', ['gambarUrl' => ($galeri && $galeri->gambar) ? $galeri->gambar_url : null])

        <div class="form-foot">
            <button type="submit" class="btn-terbit">{{ $galeri ? 'Simpan Perubahan' : 'Simpan' }}</button>
        </div>
    </form>

</div>
@endsection