<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'admin')->first() ?? new User;

        $user->forceFill([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@smkn4bogor.sch.id',
            'password' => Hash::make('admin123'), // GANTI setelah berhasil login
        ])->save();
    }
}
