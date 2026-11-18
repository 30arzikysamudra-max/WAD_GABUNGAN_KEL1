<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AllModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_role_can_view_all_four_modules_but_cannot_modify(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/buku')->assertStatus(200)->assertSee('Katalog');
        $this->actingAs($user)->get('/members')->assertStatus(200)->assertSee('Modul Anggota');
        $this->actingAs($user)->get('/penerbit')->assertStatus(200)->assertSee('Daftar Penerbit');
        $this->actingAs($user)->get('/fasilitas')->assertStatus(200)->assertSee('Fasilitas Perpustakaan');
        $this->actingAs($user)->get('/area')->assertStatus(200)->assertSee('Area Baca');

        $this->actingAs($user)->get('/buku/create')->assertStatus(403);
        $this->actingAs($user)->post('/members', [])->assertStatus(403);
        $this->actingAs($user)->get('/fasilitas/create')->assertStatus(403);
        $this->actingAs($user)->get('/area/create')->assertStatus(403);
    }

    public function test_admin_role_can_access_all_four_modules_create_and_store(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->get('/buku/create')->assertStatus(200);
        $this->actingAs($admin)->get('/fasilitas/create')->assertStatus(200);
        $this->actingAs($admin)->get('/area/create')->assertStatus(200);

        $this->actingAs($admin)->post('/buku', [
            'judul' => 'Buku Baru',
            'isbn' => '978-123456',
            'tahun_terbit' => 2026,
            'pengarang' => 'Penulis',
            'kategori' => 'Teknologi',
        ])->assertRedirect('/buku');

        $this->actingAs($admin)->post('/members', [
            'nomor_kartu' => 'LIB-2026999',
            'nama' => 'Anggota Baru',
            'email' => 'baru@perpustakaan.com',
            'no_hp' => '081234567899',
            'tipe_keanggotaan' => 'Mahasiswa',
            'alamat' => 'Bandung',
        ])->assertRedirect('/members');

        $this->actingAs($admin)->post('/fasilitas', [
            'nama_fasilitas' => 'Ruang Diskusi',
            'keterangan' => 'Tersedia',
        ])->assertRedirect('/fasilitas');
    }
}
