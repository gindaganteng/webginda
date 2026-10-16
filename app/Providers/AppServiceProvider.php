<?php

namespace App\Providers;

use App\Models\Profil;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'layouts.admin', 'login'], function ($view) {
            $profil = Schema::hasTable('profils') ? Profil::first() : null;

            $view->with('profil', $profil ?? new Profil([
                'nama_perusahaan' => 'PT Solusi Koneksi Anda',
                'alamat' => '-',
                'telepon' => '-',
                'email' => '-',
                'jam_kerja' => '-',
            ]));
        });
    }
}