@extends('layouts.admin')

@section('title', 'Profil Perusahaan')

@section('header_custom')
<header class="topbar-form">
    <h1>Profil Perusahaan</h1>
</header>
@endsection

@section('content')
<div class="form-wrap">

    <div class="form-head">
        <div>
            <h2>Edit Profil Perusahaan</h2>
            <p>Profil bersifat statis: hanya dapat diperbarui, tidak dapat ditambah atau dihapus.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.profil.update') }}" class="form-card" novalidate>
        @csrf
        @method('PUT')

        @if (session('sukses'))
            <div class="alert-sukses" role="status">{{ session('sukses') }}</div>
        @endif

        <div class="fg">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}" required>
            @error('nama_perusahaan')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="tentang">Tentang Perusahaan</label>
            <textarea id="tentang" name="tentang" required>{{ old('tentang', $data->tentang) }}</textarea>
            @error('tentang')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="sejarah">Sejarah</label>
            <textarea id="sejarah" name="sejarah" required>{{ old('sejarah', $data->sejarah) }}</textarea>
            <small class="hint">Pisahkan paragraf dengan satu baris kosong.</small>
            @error('sejarah')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="visi">Visi</label>
            <textarea id="visi" name="visi" required>{{ old('visi', $data->visi) }}</textarea>
            @error('visi')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="misi">Misi</label>
            <textarea id="misi" name="misi" required>{{ old('misi', $data->misi) }}</textarea>
            <small class="hint">Tulis satu poin misi per baris.</small>
            @error('misi')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $data->alamat) }}" required>
            @error('alamat')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="fg-row">
            <div class="fg">
                <label for="telepon">Telepon</label>
                <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $data->telepon) }}" required>
                @error('telepon')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="fg">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="fg">
            <label for="jam_kerja">Jam Operasional</label>
            <input type="text" id="jam_kerja" name="jam_kerja" value="{{ old('jam_kerja', $data->jam_kerja) }}">
            @error('jam_kerja')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-foot">
            <button type="submit" class="btn-terbit">Simpan Perubahan</button>
        </div>
    </form>

</div>
@endsection