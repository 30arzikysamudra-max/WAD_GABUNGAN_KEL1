<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fasilitas')) {
            return;
        }

        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas', 100);
            $table->enum('keterangan', ['Tersedia', 'Tidak Tersedia'])->default('Tersedia');
            $table->timestamps();
        });

        DB::table('fasilitas')->insert([
            ['nama_fasilitas' => 'WiFi', 'keterangan' => 'Tersedia', 'created_at' => now(), 'updated_at' => now()],
            ['nama_fasilitas' => 'Stopkontak', 'keterangan' => 'Tersedia', 'created_at' => now(), 'updated_at' => now()],
            ['nama_fasilitas' => 'Meja', 'keterangan' => 'Tersedia', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};

