<div class="form-box">
  @if ($errors->any())
    <div class="alert-error">
      <ul>
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
      @method($method)
    @endif

    <label>Nama Fasilitas</label>
    <input type="text" name="nama_fasilitas" maxlength="100"
           value="{{ old('nama_fasilitas', $fasilitas?->nama_fasilitas) }}" required>

    <label>Keterangan</label>
    <select name="keterangan">
      @foreach (['Tersedia', 'Tidak Tersedia'] as $o)
        <option value="{{ $o }}" @selected(old('keterangan', $fasilitas?->keterangan ?? 'Tersedia') === $o)>{{ $o }}</option>
      @endforeach
    </select>

    <br><br>
    <input type="submit" value="{{ $tombol }}">
    <a href="{{ route('fasilitas.index') }}" class="btn-batal">Batal</a>
  </form>
</div>

