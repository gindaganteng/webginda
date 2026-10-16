<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'kategori', 'deskripsi', 'harga', 'gambar'];

       public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('uploads/' . $this->gambar)
            : asset('images/placeholder.svg');
    }
}