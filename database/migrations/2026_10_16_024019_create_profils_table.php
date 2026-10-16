<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 150);
            $table->text('tentang');
            $table->text('sejarah');
            $table->text('visi');
            $table->text('misi');
            $table->string('alamat');
            $table->string('telepon', 30);
            $table->string('email', 100);
            $table->string('jam_kerja')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};