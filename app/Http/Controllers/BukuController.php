<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BukuController extends Controller
{
    private function aturan(): array
    {
        return [
            'judul' => 'required|max:150',
            'isbn' => 'required|max:20',
            'tahun_terbit' => 'required|integer',
            'pengarang' => 'required|max:100',
            'kategori' => 'required|max:50',
        ];
    }

    public function index(): View
    {
        $buku = Buku::orderBy('id_buku')->get();

        $total = $buku->count();
        $pengarang = $buku->pluck('pengarang')->unique()->count();
        $kategori = $buku->pluck('kategori')->unique()->count();
        $tahunTerbaru = $buku->max('tahun_terbit');

        return view('buku.index', compact('buku', 'total', 'pengarang', 'kategori', 'tahunTerbaru'));
    }

    public function create(): View
    {
        return view('buku.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Buku::create($request->validate($this->aturan()));

        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil ditambahkan!');
    }

    public function edit(Buku $buku): View
    {
        return view('buku.form', compact('buku'));
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $buku->update($request->validate($this->aturan()));

        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil dihapus!');
    }
}

