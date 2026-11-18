@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
  <h2>Edit Data Anggota</h2>

  <div class="form-box">
    @if ($errors->any())
      <div class="alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('members.update', $member->id) }}" method="POST">
      @csrf
      @method('PUT')

      <label>Nomor Kartu</label>
      <input type="text" name="nomor_kartu" value="{{ old('nomor_kartu', $member->nomor_kartu) }}" required>

      <label>Nama Lengkap</label>
      <input type="text" name="nama" value="{{ old('nama', $member->nama) }}" required>

      <label>Tipe Keanggotaan</label>
      <select name="tipe_keanggotaan" required>
        <option value="Mahasiswa" @selected($member->tipe_keanggotaan == 'Mahasiswa')>Mahasiswa</option>
        <option value="Dosen" @selected($member->tipe_keanggotaan == 'Dosen')>Dosen</option>
        <option value="Umum" @selected($member->tipe_keanggotaan == 'Umum')>Umum</option>
      </select>

      <label>Email</label>
      <input type="email" name="email" value="{{ old('email', $member->email) }}" required>

      <label>No. HP</label>
      <input type="text" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}" required>

      <label>Alamat</label>
      <input type="text" name="alamat" value="{{ old('alamat', $member->alamat) }}" required>

      <br><br>
      <input type="submit" value="Update">
      <a href="{{ route('members.index') }}" class="btn-batal">Batal</a>
    </form>
  </div>
@endsection

