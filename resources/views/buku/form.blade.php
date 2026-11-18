@extends('layouts.app')

@section('title', isset($buku) ? 'Edit Buku' : 'Tambah Buku')

@section('content')
  <h2>{{ isset($buku) ? 'Form Edit Buku' : 'Form Tambah Buku' }}</h2>

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

    <form method="POST" action="{{ isset($buku) ? route('buku.update', $buku->id_buku) : route('buku.store') }}">
      @csrf
      @if (isset($buku))
        @method('PUT')
      @endif

      <label for="judul">Judul Buku:</label>
      <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul ?? '') }}" required>

      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn ?? '') }}" required>

      <label for="tahun_terbit">Tahun Terbit:</label>
      <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" required>

      <label for="pengarang">Pengarang:</label>
      <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang ?? '') }}" required>

      <label for="kategori">Kategori:</label>
      @php
        $daftar = ['Novel', 'Komik', 'Pendidikan', 'Teknologi', 'Kesehatan', 'Komedi', 'Kartun', 'Kuliner', 'Lainnya'];
        $dipilih = old('kategori', $buku->kategori ?? '');
      @endphp
      <select id="kategori" name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($daftar as $k)
          <option value="{{ $k }}" @selected($dipilih == $k)>{{ $k }}</option>
        @endforeach
      </select>

      <br><br>
      <input type="submit" value="Simpan">
      <a href="{{ route('buku.index') }}" class="btn-batal">Batal</a>
    </form>
  </div>
@endsection

