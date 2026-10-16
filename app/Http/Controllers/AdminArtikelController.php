<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class AdminArtikelController extends Controller
{
    private const KATEGORI = ['Tips', 'Pengumuman', 'Informasi'];

    private function aturan(): array
    {
        return [
            'judul'     => ['required', 'string', 'max:150'],
            'kategori'  => ['required', 'in:' . implode(',', self::KATEGORI)],
            'tanggal'   => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'gambar'    => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
        ];
    }

    private function pesan(): array
    {
        return [
            'judul.required'     => 'Judul artikel wajib diisi.',
            'kategori.required'  => 'Pilih kategori artikel.',
            'tanggal.required'   => 'Tanggal publikasi wajib diisi.',
            'deskripsi.required' => 'Isi artikel wajib diisi.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.mimes'       => 'Gambar harus berformat PNG atau JPG.',
            'gambar.max'         => 'Ukuran gambar maksimal 5MB.',
        ];
    }

    public function index(Request $request)
    {
        $cari = trim((string) $request->query('q'));
        $kategori = $request->query('kategori');

        $artikels = Artikel::query()
            ->when($cari, fn ($q) => $q->where('judul', 'like', "%{$cari}%"))
            ->when($kategori, fn ($q) => $q->where('kategori', $kategori))
            ->orderByDesc('tanggal')
            ->paginate(5)
            ->withQueryString();

        return view('admin.artikel.index', [
            'artikels' => $artikels,
            'kategoriList' => self::KATEGORI,
            'cari' => $cari,
            'kategori' => $kategori,
            'terbaru' => Artikel::orderByDesc('tanggal')->first(),
            'total' => Artikel::count(),
        ]);
    }

    public function create()
    {
        return view('admin.artikel.form', ['artikel' => null, 'kategoriList' => self::KATEGORI]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());
        $data['gambar'] = $this->simpanGambar($request, 'artikel');

        Artikel::create($data);

        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil diterbitkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.form', ['artikel' => $artikel, 'kategoriList' => self::KATEGORI]);
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($artikel->gambar);
            $data['gambar'] = $this->simpanGambar($request, 'artikel');
        } else {
            unset($data['gambar']);
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $this->hapusGambar($artikel->gambar);
        $artikel->delete();

        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil dihapus.');
    }
}