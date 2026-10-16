<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class AdminProfilController extends Controller
{
    public function edit()
    {
        return view('admin.profil.edit', ['data' => Profil::first() ?? new Profil]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:150'],
            'tentang'   => ['required', 'string'],
            'sejarah'   => ['required', 'string'],
            'visi'      => ['required', 'string'],
            'misi'      => ['required', 'string'],
            'alamat'    => ['required', 'string', 'max:255'],
            'telepon'   => ['required', 'string', 'max:30'],
            'email'     => ['required', 'email', 'max:100'],
            'jam_kerja' => ['nullable', 'string', 'max:255'],
        ], [
            'required' => 'Kolom ini wajib diisi.',
            'email'    => 'Format email tidak valid.',
        ]);

        Profil::updateOrCreate(['id' => 1], $data);

        return redirect()->route('admin.profil')->with('sukses', 'Profil perusahaan berhasil diperbarui.');
    }
}