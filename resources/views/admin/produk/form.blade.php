@extends('layouts.admin')

@section('title', $produk ? 'Edit Produk / Layanan' : 'Tambah Produk / Layanan')

@section('header_custom')
<header class="topbar-form">
    <h1>{{ $produk ? 'Edit' : 'Tambah' }} Produk / Layanan</h1>
</header>
@endsection

@section('content')
<div class="form-wrap">

    <div class="form-head">
        <div>
            <h2>Informasi Produk / Layanan</h2>
            <p>Lengkapi detail di bawah ini.</p>
        </div>
        <nav class="crumb-up" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ route('admin.produk') }}">Produk / Layanan</a>
            <i class="fa-solid fa-angle-right"></i>
            <strong>{{ $produk ? 'Edit' : 'Baru' }}</strong>
        </nav>
    </div>

    <form method="POST"
          action="{{ $produk ? route('admin.produk.update', $produk) : route('admin.produk.simpan') }}"
          enctype="multipart/form-data" class="form-card" novalidate>
        @csrf
        @if ($produk) @method('PUT') @endif

        <div class="fg">
            <label for="nama">Nama Produk / Layanan</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $produk->nama ?? '') }}" required>
            @error('nama')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg-row">
            <div class="fg">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" list="daftar-kategori"
                       value="{{ old('kategori', $produk->kategori ?? '') }}" placeholder="Contoh: Jaringan" required>
                <datalist id="daftar-kategori">
                    @foreach ($kategoriList as $k)<option value="{{ $k }}">@endforeach
                </datalist>
                @error('kategori')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="fg">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" min="0" value="{{ old('harga', $produk->harga ?? '') }}" placeholder="Kosongkan jika tidak ada">
                @error('harga')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        @include('admin.partials.gambar', ['gambarUrl' => ($produk && $produk->gambar) ? $produk->gambar_url : null])

        <div class="fg">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan produk / layanan ini...">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-foot">
            <button type="submit" class="btn-terbit">{{ $produk ? 'Simpan Perubahan' : 'Simpan' }}</button>
        </div>
    </form>

</div>
@endsection