<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'nama_perusahaan', 'tentang', 'sejarah', 'visi', 'misi',
        'alamat', 'telepon', 'email', 'jam_kerja',
    ];
}