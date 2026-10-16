<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

abstract class Controller
{
    protected function simpanGambar(Request $request, string $folder): ?string
    {
        if (! $request->hasFile('gambar')) {
            return null;
        }

        $file = $request->file('gambar');
        $nama = uniqid() . '.' . $file->extension();
        $file->move(public_path('uploads/' . $folder), $nama);

        return $folder . '/' . $nama;
    }

    protected function hapusGambar(?string $path): void
    {
        if ($path && File::exists(public_path('uploads/' . $path))) {
            File::delete(public_path('uploads/' . $path));
        }
    }
}