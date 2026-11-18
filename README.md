# Sistem Manajemen Perpustakaan Digital (Studi Kasus 01)

Aplikasi web berbasis Laravel untuk pengelolaan data perpustakaan digital dengan autentikasi dan pembagian hak akses role **Admin** dan **User**.

## Pembagian Modul Kelompok
- **Modul A (Katalog & Buku):** Daaniys Nur Aaqilah Putri (`102022500054`) — Route `/buku` (`routes/buku.php`)
- **Modul B (Anggota & Kartu):** Luh Putu Deananda Juliadewi (`102022500114`) — Route `/anggota` (`routes/anggota.php`)
- **Modul C (Penerbit & Supplier):** Arziky Samudra Marpaung (`102022500050`) — Route `/penerbit` (`routes/penerbit.php`)
- **Modul D (Fasilitas & Area):** Raihanul Akbar (`102022500186`) — Route `/fasilitas` & `/area` (`routes/fasilitas.php`)

## Cara Menjalankan
1. Nyalakan **Apache** dan **MySQL** di XAMPP, lalu pastikan database `db_perpustakaan` tersedia.
2. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```
3. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```
4. Akses `http://127.0.0.1:8000` di browser.

## Akun Pengujian (Seeder)
- **Admin:** `admin@perpustakaan.com` / Password: `102022500050` (Akses penuh CRUD)
- **User:** `user@perpustakaan.com` / Password: `102022500050` (Akses lihat/cari data saja)

## Panduan Merge Modul Anggota Kelompok (Anti-Conflict)
1. **Jangan mengubah `routes/web.php`** — cukup buat file route modul masing-masing:
   - Modul A: `routes/buku.php`
   - Modul B: `routes/anggota.php`
   - Modul C: `routes/penerbit.php`
   - Modul D: `routes/fasilitas.php`
   File `routes/web.php` akan memuat keempat file tersebut secara otomatis jika tersedia.
2. **Gunakan middleware yang sudah terdaftar:**
   - `middleware('auth')` untuk halaman daftar/lihat data (`index` / `show`).
   - `middleware(['auth', 'role:admin'])` untuk aksi tambah, ubah, dan hapus (`create`, `store`, `edit`, `update`, `destroy`).
3. **Gunakan layout bersama:**
   - Tambahkan `@extends('layouts.app')` dan `@section('content')` di setiap halaman Blade modul. Menu navigasi di topbar akan otomatis muncul ketika route `buku.index`, `anggota.index`, `penerbit.index`, `fasilitas.index`, atau `area.index` terdaftar.
4. **Jangan menambahkan migration `add_role_to_users_table` baru** karena kolom `role` sudah tersedia di migration base.
