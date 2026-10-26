<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    /**
     * Nama tabel sesuai db_perpustakaan.sql (bukan "penerbits").
     */
    protected $table = 'penerbit';

    /**
     * Tabel hanya punya created_at, tidak ada updated_at.
     */
    const UPDATED_AT = null;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_penerbit',
        'nama_sales',
        'kontak_sales',
        'alamat',
        'wilayah_asal',
    ];
}
