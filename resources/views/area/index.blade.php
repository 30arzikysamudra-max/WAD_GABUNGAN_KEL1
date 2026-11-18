@extends('layouts.app')

@section('title', 'Area Baca Perpustakaan')

@section('content')
  <h2>Area Baca &amp; Meja Perpustakaan</h2>
  <p class="subtitle">Modul Individu D: Pengelolaan data meja/bilik baca, nomor lantai, fasilitas stopkontak/WiFi, dan ketersediaan area.</p>

  @if (! auth()->user()?->isAdmin())
    <div class="alert-info">
      Anda masuk sebagai <strong>User</strong> (akses lihat &amp; cari meja). Hanya <strong>Admin</strong> yang dapat menambah, mengubah, atau menghapus data meja.
    </div>
  @endif

  <div class="toolbar">
    <form action="{{ route('area.index') }}" method="GET" class="filter-form">
      <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama meja...">
      <input type="submit" value="Cari">
      @if (request('cari'))
        <a href="{{ route('area.index') }}" class="btn-batal" style="margin-left: 0;">Reset</a>
      @endif
    </form>

    @if (auth()->user()?->isAdmin())
      <a href="{{ route('area.create') }}" class="button-link">+ Tambah Meja</a>
    @endif
  </div>

  <div class="area-grid">
    @forelse ($meja as $m)
      <div class="area-card">
        @if ($m->gambar)
          <img src="{{ asset('gambar/' . rawurlencode($m->gambar)) }}" alt="{{ $m->nama_meja }}">
        @else
          <div class="area-noimg">Tanpa gambar</div>
        @endif

        <h3 style="margin: 10px 0 4px;">{{ $m->nama_meja }}</h3>
        <p style="margin: 2px 0; font-size: 14px; color: #334155;">Lantai {{ $m->lantai }}</p>
        <p style="margin: 2px 0; font-size: 14px; color: #334155;">WiFi: <strong>{{ $m->wifi }}</strong> | Stopkontak: <strong>{{ $m->stopkontak }}</strong></p>
        <p style="margin: 8px 0;">
          <span class="badge-wilayah {{ $m->status === 'Tersedia' ? 'badge-nasional' : 'badge-internasional' }}">
            {{ $m->status }}
          </span>
        </p>

        @if (auth()->user()?->isAdmin())
          <div class="action-group" style="margin-top: 8px;">
            <a href="{{ route('area.edit', $m) }}" class="btn-edit">Edit</a>
            <form method="POST" action="{{ route('area.destroy', $m) }}" class="inline"
                  onsubmit="return confirm('Yakin hapus meja ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-hapus">Hapus</button>
            </form>
          </div>
        @endif
      </div>
    @empty
      <p style="color: #64748b;">Belum ada data meja.</p>
    @endforelse
  </div>

  <p style="margin-top: 20px;">
    <a href="{{ route('fasilitas.index') }}" class="button-link">&larr; Kembali ke Fasilitas</a>
  </p>
@endsection

