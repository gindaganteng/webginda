<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class AdminGaleriController extends Controller
{
    private function aturan(bool $wajibGambar): array
    {
        return [
            'judul'   => ['required', 'string', 'max:150'],
            'tanggal' => ['required', 'date'],
            'gambar'  => [$wajibGambar ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
        ];
    }

    private function pesan(): array
    {
        return [
            'judul.required'   => 'Judul kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'gambar.required'  => 'Foto kegiatan wajib diunggah.',
            'gambar.image'     => 'File harus berupa gambar.',
            'gambar.mimes'     => 'Gambar harus berformat PNG atau JPG.',
            'gambar.max'       => 'Ukuran gambar maksimal 5MB.',
        ];
    }

    public function index(Request $request)
    {
        $cari = trim((string) $request->query('q'));

        $galeris = Galeri::query()
            ->when($cari, fn ($q) => $q->where('judul', 'like', "%{$cari}%"))
            ->orderByDesc('tanggal')
            ->paginate(8)
            ->withQueryString();

        return view('admin.galeri.index', ['galeris' => $galeris, 'cari' => $cari]);
    }

    public function create()
    {
        return view('admin.galeri.form', ['galeri' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(true), $this->pesan());
        $data['gambar'] = $this->simpanGambar($request, 'galeri');

        Galeri::create($data);

        return redirect()->route('admin.galeri')->with('sukses', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', ['galeri' => $galeri]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate($this->aturan(false), $this->pesan());

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($galeri->gambar);
            $data['gambar'] = $this->simpanGambar($request, 'galeri');
        } else {
            unset($data['gambar']);
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri')->with('sukses', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $this->hapusGambar($galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri')->with('sukses', 'Foto galeri berhasil dihapus.');
    }
}