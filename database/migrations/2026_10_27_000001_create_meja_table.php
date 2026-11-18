<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('meja')) {
            return;
        }

        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_meja', 50);
            $table->unsignedTinyInteger('lantai');
            $table->enum('wifi', ['Ya', 'Tidak'])->default('Ya');
            $table->enum('stopkontak', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('status', ['Tersedia', 'Digunakan'])->default('Tersedia');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        DB::table('meja')->insert([
            ['nama_meja' => 'Meja 01', 'lantai' => 1, 'wifi' => 'Ya', 'stopkontak' => 'Tidak', 'status' => 'Tersedia', 'gambar' => 'download.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama_meja' => 'Meja 02', 'lantai' => 1, 'wifi' => 'Ya', 'stopkontak' => 'Ya', 'status' => 'Digunakan', 'gambar' => 'Shared Library Computer Tables that Offer Personal Space.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama_meja' => 'Meja 03', 'lantai' => 2, 'wifi' => 'Ya', 'stopkontak' => 'Tidak', 'status' => 'Tersedia', 'gambar' => 'meja.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama_meja' => 'Meja 04', 'lantai' => 2, 'wifi' => 'Ya', 'stopkontak' => 'Ya', 'status' => 'Tersedia', 'gambar' => 'Perpustakaan Kabupaten Pinrang.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};

