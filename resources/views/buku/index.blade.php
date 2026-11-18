@extends('layouts.app')

@section('title', 'Pengelolaan Master Data Buku')

@section('content')
  <h2>Katalog &amp; Master Data Buku</h2>
  <p class="subtitle">Modul Individu A: Pengelolaan master data buku, judul, ISBN, tahun terbit, pengarang, dan kategori literatur.</p>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Total Buku</div>
      <div class="stat-value">{{ $total }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Pengarang</div>
      <div class="stat-value">{{ $pengarang }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Kategori</div>
      <div class="stat-value">{{ $kategori }}</div>
    </div>
    <div class="stat-card stat-amber">
      <div class="stat-label">Tahun Terbaru</div>
      <div class="stat-value">{{ $tahunTerbaru ?? '-' }}</div>
    </div>
  </div>

  @if (auth()->user()?->isAdmin())
    <p>
      <a href="{{ route('buku.create') }}" class="button-link">+ Tambah Buku Baru</a>
    </p>
  @else
    <div class="alert-info">
      Anda masuk sebagai <strong>User</strong> (akses lihat katalog buku). Hanya <strong>Admin</strong> yang dapat menambah, mengubah, atau menghapus data buku.
    </div>
  @endif

  <div class="table-wrap">
    <table>
      <tr>
        <th style="width: 50px;">No</th>
        <th>Judul Buku</th>
        <th>ISBN</th>
        <th>Tahun Terbit</th>
        <th>Pengarang</th>
        <th>Kategori</th>
        @if (auth()->user()?->isAdmin())
          <th style="width: 150px; text-align: center;">Aksi</th>
        @endif
      </tr>
      @forelse ($buku as $b)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><strong>{{ $b->judul }}</strong></td>
          <td>{{ $b->isbn }}</td>
          <td>{{ $b->tahun_terbit }}</td>
          <td>{{ $b->pengarang }}</td>
          <td><span class="badge-wilayah badge-nasional">{{ $b->kategori }}</span></td>
          @if (auth()->user()?->isAdmin())
            <td style="text-align: center;">
              <div class="action-group">
                <a href="{{ route('buku.edit', $b->id_buku) }}" class="btn-edit">Edit</a>
                <form action="{{ route('buku.destroy', $b->id_buku) }}" method="POST" class="inline"
                      onsubmit="return confirm('Yakin hapus buku ini?')">
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
          <td colspan="{{ auth()->user()?->isAdmin() ? 7 : 6 }}" style="text-align: center; color: #64748b;">Belum ada data buku.</td>
        </tr>
      @endforelse
    </table>
  </div>
@endsection

