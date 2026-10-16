@extends('layouts.admin')

@section('title', $artikel ? 'Edit Artikel' : 'Tambah Artikel')

@section('header_custom')
<header class="topbar-form">
    <h1>{{ $artikel ? 'Edit Artikel' : 'Tambah Artikel Baru' }}</h1>
</header>
@endsection

@section('content')
<div class="form-wrap">

    <div class="form-head">
        <div>
            <h2>Informasi Artikel</h2>
            <p>Lengkapi detail di bawah ini.</p>
        </div>
        <nav class="crumb-up" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ route('admin.artikel') }}">Artikel</a>
            <i class="fa-solid fa-angle-right"></i>
            <strong>{{ $artikel ? 'Edit' : 'Baru' }}</strong>
        </nav>
    </div>

    <form method="POST"
          action="{{ $artikel ? route('admin.artikel.update', $artikel) : route('admin.artikel.simpan') }}"
          enctype="multipart/form-data" class="form-card" novalidate>
        @csrf
        @if ($artikel) @method('PUT') @endif

        <div class="fg">
            <label for="judul">Judul Artikel</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul ?? '') }}" required>
            @error('judul')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg-row">
            <div class="fg">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoriList as $k)
                        <option value="{{ $k }}" @selected(old('kategori', $artikel->kategori ?? '') === $k)>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kategori')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="fg">
                <label for="tanggal">Tanggal Publikasi</label>
                <input type="date" id="tanggal" name="tanggal"
                       value="{{ old('tanggal', optional($artikel->tanggal ?? null)->format('Y-m-d')) }}" required>
                @error('tanggal')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        @include('admin.partials.gambar', ['gambarUrl' => ($artikel && $artikel->gambar) ? $artikel->gambar_url : null])

        <div class="fg">
            <label for="deskripsi">Isi Artikel</label>
            <textarea id="deskripsi" name="deskripsi" style="min-height:220px" placeholder="Tuliskan artikel atau informasi di sini...">{{ old('deskripsi', $artikel->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-foot">
            <button type="submit" class="btn-terbit">{{ $artikel ? 'Simpan Perubahan' : 'Terbitkan Artikel' }}</button>
        </div>
    </form>

</div>
@endsection