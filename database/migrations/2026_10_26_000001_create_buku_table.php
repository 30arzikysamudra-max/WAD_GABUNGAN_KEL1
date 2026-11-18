<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('buku')) {
            return;
        }

        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id_buku');
            $table->string('judul', 150);
            $table->string('isbn', 20);
            $table->integer('tahun_terbit');
            $table->string('pengarang', 100);
            $table->string('kategori', 50);
        });

        DB::table('buku')->insert([
            ['judul' => 'Pemrograman Web Modern dengan Laravel', 'isbn' => '978-602-03-1122-1', 'tahun_terbit' => 2024, 'pengarang' => 'Budi Raharjo', 'kategori' => 'Teknologi'],
            ['judul' => 'Laskar Pelangi', 'isbn' => '978-979-3062-79-2', 'tahun_terbit' => 2005, 'pengarang' => 'Andrea Hirata', 'kategori' => 'Novel'],
            ['judul' => 'Pengantar Sistem Informasi', 'isbn' => '978-602-444-555-3', 'tahun_terbit' => 2023, 'pengarang' => 'Jogiyanto HM', 'kategori' => 'Pendidikan'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

