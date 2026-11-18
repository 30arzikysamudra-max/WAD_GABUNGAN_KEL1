@extends('layouts.app')

@section('title', 'Fasilitas Perpustakaan')

@section('content')
  <h2>Fasilitas Perpustakaan</h2>
  <p class="subtitle">Modul Individu D: Pengelolaan data fasilitas ruang baca perpustakaan.</p>

  @if (auth()->user()?->isAdmin())
    <p>
      <a href="{{ route('fasilitas.create') }}" class="button-link">+ Tambah Fasilitas</a>
    </p>
  @else
    <div class="alert-info">
      Anda masuk sebagai <strong>User</strong> (akses lihat fasilitas saja). Hanya <strong>Admin</strong> yang dapat menambah, mengubah, atau menghapus fasilitas.
    </div>
  @endif

  <div class="table-wrap">
    <table>
      <tr>
        <th style="width: 50px;">No</th>
        <th>Fasilitas</th>
        <th>Keterangan</th>
        @if (auth()->user()?->isAdmin())
          <th style="width: 150px; text-align: center;">Aksi</th>
        @endif
      </tr>
      @forelse ($fasilitas as $f)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><strong>{{ $f->nama_fasilitas }}</strong></td>
          <td>
            <span class="badge-wilayah {{ $f->keterangan === 'Tersedia' ? 'badge-nasional' : 'badge-internasional' }}">
              {{ $f->keterangan }}
            </span>
          </td>
          @if (auth()->user()?->isAdmin())
            <td style="text-align: center;">
              <div class="action-group">
                <a href="{{ route('fasilitas.edit', $f) }}" class="btn-edit">Edit</a>
                <form method="POST" action="{{ route('fasilitas.destroy', $f) }}" class="inline"
                      onsubmit="return confirm('Yakin hapus fasilitas ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-hapus">Hapus</button>
                </form>
              </div>
            </td>
          @endif
        </tr>
      @empty
        <tr>
          <td colspan="{{ auth()->user()?->isAdmin() ? 4 : 3 }}" style="text-align: center; color: #64748b;">Belum ada data fasilitas.</td>
        </tr>
      @endforelse
    </table>
  </div>

  <p style="margin-top: 18px;">
    <a href="{{ route('area.index') }}" class="button-link">Lihat Halaman Area Baca &rarr;</a>
  </p>
@endsection

