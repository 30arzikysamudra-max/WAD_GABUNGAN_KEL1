<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('members')) {
            return;
        }

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kartu')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('tipe_keanggotaan');
            $table->text('alamat');
            $table->timestamps();
        });

        DB::table('members')->insert([
            ['nomor_kartu' => 'LIB-2026001', 'nama' => 'Luh Putu Deananda', 'email' => 'deananda@perpustakaan.com', 'no_hp' => '081234567801', 'tipe_keanggotaan' => 'Mahasiswa', 'alamat' => 'Bandung', 'created_at' => now(), 'updated_at' => now()],
            ['nomor_kartu' => 'LIB-2026002', 'nama' => 'Daaniys Nur Aaqilah', 'email' => 'daaniys@perpustakaan.com', 'no_hp' => '081234567802', 'tipe_keanggotaan' => 'Mahasiswa', 'alamat' => 'Bandung', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

