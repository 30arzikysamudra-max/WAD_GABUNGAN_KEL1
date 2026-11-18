@extends('layouts.app')

@section('title', 'Modul Anggota & Kartu Perpustakaan')

@section('content')
  <h2>Modul Anggota &amp; Kartu Perpustakaan</h2>
  <p class="subtitle">Modul Individu B: Pengelolaan profil anggota perpustakaan, nomor kartu, tipe keanggotaan, dan cetak ID card.</p>

  @if ($errors->any())
    <div class="alert-error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (auth()->user()?->isAdmin())
    <div class="form-box" style="max-width: 100%; margin-bottom: 22px;">
      <h3 style="margin-top: 0; margin-bottom: 12px; color: #0369a1;">Tambah Anggota Baru</h3>
      <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px;">
          <div>
            <label>Nomor Kartu</label>
            <input type="text" name="nomor_kartu" placeholder="Contoh: LIB-2026003" value="{{ old('nomor_kartu') }}" required>
          </div>
          <div>
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required>
          </div>
          <div>
            <label>Tipe Keanggotaan</label>
            <select name="tipe_keanggotaan" required>
              <option value="Mahasiswa">Mahasiswa</option>
              <option value="Dosen">Dosen</option>
              <option value="Umum">Umum</option>
            </select>
          </div>
          <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
          </div>
          <div>
            <label>No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>
          </div>
          <div>
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" required>
          </div>
        </div>
        <input type="submit" value="Simpan Anggota">
      </form>
    </div>
  @else
    <div class="alert-info">
      Anda masuk sebagai <strong>User</strong>. Anda dapat melihat daftar anggota dan mencetak ID Card. Hanya <strong>Admin</strong> yang dapat menambah, mengubah, atau menghapus anggota.
    </div>
  @endif

  <div class="table-wrap">
    <table>
      <tr>
        <th>No. Kartu</th>
        <th>Nama</th>
        <th>Tipe</th>
        <th>Email / No. HP</th>
        <th>Alamat</th>
        <th style="width: 220px; text-align: center;">Aksi</th>
      </tr>
      @forelse ($members as $member)
        <tr>
          <td><strong>{{ $member->nomor_kartu }}</strong></td>
          <td>{{ $member->nama }}</td>
          <td><span class="badge-wilayah badge-nasional">{{ $member->tipe_keanggotaan }}</span></td>
          <td>{{ $member->email }}<br><small style="color: #64748b;">{{ $member->no_hp }}</small></td>
          <td>{{ $member->alamat }}</td>
          <td style="text-align: center;">
            <div class="action-group">
              <a href="{{ route('members.card', $member->id) }}" target="_blank" class="btn-detail">Cetak ID Card</a>
              @if (auth()->user()?->isAdmin())
                <a href="{{ route('members.edit', $member->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Hapus anggota ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-hapus">Hapus</button>
                </form>
              @endif
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align: center; color: #64748b;">Belum ada data anggota.</td>
        </tr>
      @endforelse
    </table>
  </div>
@endsection

