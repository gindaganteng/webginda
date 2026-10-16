<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = ['judul', 'kategori', 'tanggal', 'deskripsi', 'gambar'];

    protected $casts = ['tanggal' => 'date'];
    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('uploads/' . $this->gambar)
            : asset('images/placeholder.svg');
    }
}