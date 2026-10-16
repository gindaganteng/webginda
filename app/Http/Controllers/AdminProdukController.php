<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    private function aturan(): array
    {
        return [
            'nama'      => ['required', 'string', 'max:150'],
            'kategori'  => ['required', 'string', 'max:100'],
            'harga'     => ['nullable', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'gambar'    => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
        ];
    }

    private function pesan(): array
    {
        return [
            'nama.required'     => 'Nama produk / layanan wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'harga.integer'     => 'Harga harus berupa angka.',
            'gambar.image'      => 'File harus berupa gambar.',
            'gambar.mimes'      => 'Gambar harus berformat PNG atau JPG.',
            'gambar.max'        => 'Ukuran gambar maksimal 5MB.',
        ];
    }

    public function index(Request $request)
    {
        $cari = trim((string) $request->query('q'));

        $produks = Produk::query()
            ->when($cari, fn ($q) => $q->where('nama', 'like', "%{$cari}%"))
            ->latest()
            ->get();

        return view('admin.produk.index', [
            'produks' => $produks,
            'cari' => $cari,
            'terbaru' => Produk::latest()->first(),
        ]);
    }

    public function create()
    {
        return view('admin.produk.form', [
            'produk' => null,
            'kategoriList' => Produk::select('kategori')->distinct()->pluck('kategori'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());
        $data['gambar'] = $this->simpanGambar($request, 'produk');

        Produk::create($data);

        return redirect()->route('admin.produk')->with('sukses', 'Produk / layanan berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.form', [
            'produk' => $produk,
            'kategoriList' => Produk::select('kategori')->distinct()->pluck('kategori'),
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($produk->gambar);
            $data['gambar'] = $this->simpanGambar($request, 'produk');
        } else {
            unset($data['gambar']);
        }

        $produk->update($data);

        return redirect()->route('admin.produk')->with('sukses', 'Produk / layanan berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $this->hapusGambar($produk->gambar);
        $produk->delete();

        return redirect()->route('admin.produk')->with('sukses', 'Produk / layanan berhasil dihapus.');
    }
}