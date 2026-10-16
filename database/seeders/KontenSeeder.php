<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;
use App\Models\Profil;
use Illuminate\Database\Seeder;

class KontenSeeder extends Seeder
{
    public function run(): void
    {
        Profil::updateOrCreate(['id' => 1], [
            'nama_perusahaan' => 'PT Solusi Koneksi Anda',
            'tentang'   => 'PT Solusi Koneksi Anda adalah perusahaan penyedia solusi teknologi informasi dan jaringan untuk instansi, sekolah, dan bisnis.',
            'sejarah'   => 'Berdiri dengan semangat menghubungkan setiap kebutuhan teknologi pelanggan, perusahaan terus berkembang dari layanan instalasi jaringan hingga solusi IT terpadu.',
            'visi'      => 'Menjadi mitra teknologi terpercaya yang menghubungkan masyarakat dan bisnis dengan solusi digital yang andal.',
            'misi'      => "Memberikan layanan jaringan dan IT yang berkualitas.\nMenjaga kepuasan dan kepercayaan pelanggan.\nMendukung pertumbuhan usaha pelanggan melalui teknologi.",
            'alamat'    => 'Jl. Contoh Alamat No. 1, Kota Bogor',
            'telepon'   => '+62 251 000 0000',
            'email'     => 'info@solusikoneksianda.co.id',
            'jam_kerja' => 'Senin - Jumat, 08.00 - 17.00 WIB',
        ]);

        if (Produk::count() === 0) {
            Produk::create(['nama' => 'Instalasi Jaringan LAN & WiFi', 'kategori' => 'Jaringan', 'deskripsi' => 'Perancangan dan pemasangan jaringan kabel dan nirkabel untuk kantor, sekolah, dan rumah.', 'harga' => 2500000]);
            Produk::create(['nama' => 'Pembuatan Website', 'kategori' => 'Software', 'deskripsi' => 'Website company profile dan sistem informasi sesuai kebutuhan bisnis Anda.', 'harga' => 3500000]);
            Produk::create(['nama' => 'Maintenance & Support IT', 'kategori' => 'Layanan', 'deskripsi' => 'Perawatan berkala perangkat dan jaringan serta dukungan teknis cepat.', 'harga' => 1500000]);
            Produk::create(['nama' => 'Pemasangan CCTV', 'kategori' => 'Keamanan', 'deskripsi' => 'Pemasangan kamera pengawas lengkap dengan konfigurasi pemantauan jarak jauh.', 'harga' => 4000000]);
        }

        if (Artikel::count() === 0) {
            Artikel::create(['judul' => 'Tips Menjaga Koneksi WiFi Tetap Stabil', 'kategori' => 'Tips', 'tanggal' => '2026-10-01', 'deskripsi' => 'Letakkan router di titik tengah, hindari penghalang, dan perbarui firmware secara berkala.']);
            Artikel::create(['judul' => 'Layanan Baru: Pemasangan CCTV', 'kategori' => 'Pengumuman', 'tanggal' => '2026-09-20', 'deskripsi' => 'Kami kini melayani pemasangan CCTV untuk rumah, toko, dan perkantoran.']);
            Artikel::create(['judul' => 'Studi Kasus: Jaringan Sekolah Terpadu', 'kategori' => 'Informasi', 'tanggal' => '2026-09-05', 'deskripsi' => 'Cerita proyek instalasi jaringan untuk satu sekolah dengan puluhan titik akses.']);
        }

        if (Galeri::count() === 0) {
            Galeri::create(['judul' => 'Instalasi Jaringan Kantor Klien', 'tanggal' => '2026-09-25']);
            Galeri::create(['judul' => 'Pelatihan Tim Teknisi', 'tanggal' => '2026-09-10']);
            Galeri::create(['judul' => 'Kunjungan Klien', 'tanggal' => '2026-08-28']);
        }
    }
}