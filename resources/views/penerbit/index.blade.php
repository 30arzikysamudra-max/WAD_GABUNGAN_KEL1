@extends('layouts.app')

@section('title', 'Data Penerbit dan Supplier')

@section('content')
  <h2>Daftar Penerbit dan Supplier</h2>
  <p>Modul Individu C: Pengelolaan data distributor buku, kontak sales, dan wilayah asal.</p>

  <p>
    <a href="{{ route('penerbit.create') }}" class="button-link" id="btn-tambah">+ Tambah Penerbit Baru</a>
  </p>

  <table>
    <tr>
      <th style="width: 50px;">No</th>
      <th>Nama Penerbit</th>
      <th>Nama Sales</th>
      <th>Kontak Sales</th>
      <th>Alamat</th>
      <th>Wilayah Asal</th>
      <th style="width: 140px; text-align: center;">Aksi</th>
    </tr>
    @forelse ($penerbit as $d)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nama_penerbit }}</td>
        <td>{{ $d->nama_sales }}</td>
        <td>{{ $d->kontak_sales }}</td>
        <td>{{ $d->alamat }}</td>
        <td>{{ $d->wilayah_asal }}</td>
        <td style="text-align: center;">
          <a href="{{ route('penerbit.edit', $d) }}" class="btn-edit" id="btn-edit-{{ $d->id }}">Edit</a>
          <form action="{{ route('penerbit.destroy', $d) }}" method="POST" class="inline"
                onsubmit="return confirm('Yakin ingin menghapus {{ addslashes($d->nama_penerbit) }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-hapus" id="btn-hapus-{{ $d->id }}">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7" style="text-align: center;">Belum ada data penerbit.</td>
      </tr>
    @endforelse
  </table>
@endsection
