<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['judul', 'tanggal', 'gambar'];

    protected $casts = ['tanggal' => 'date'];

     public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('uploads/' . $this->gambar)
            : asset('images/placeholder.svg');
    }
}