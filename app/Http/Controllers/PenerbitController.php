<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $penerbit = Penerbit::orderBy('id')->get();

        return view('penerbit.index', compact('penerbit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $penerbit = new Penerbit;

        return view('penerbit.form', compact('penerbit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Penerbit::create($this->validasi($request));

        return redirect()->route('penerbit.index')
            ->with('success', 'Data penerbit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerbit $penerbit): View
    {
        return view('penerbit.form', compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerbit $penerbit): RedirectResponse
    {
        $penerbit->update($this->validasi($request));

        return redirect()->route('penerbit.index')
            ->with('success', 'Data penerbit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerbit $penerbit): RedirectResponse
    {
        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('success', 'Data penerbit berhasil dihapus.');
    }

    /**
     * Aturan validasi untuk store dan update.
     *
     * @return array<string, mixed>
     */
    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama_penerbit' => ['required', 'string', 'max:150'],
            'nama_sales' => ['required', 'string', 'max:100'],
            'kontak_sales' => ['required', 'regex:/^[0-9+\-\s]+$/', 'max:50'],
            'alamat' => ['required', 'string'],
            'wilayah_asal' => ['required', 'in:Nasional,Internasional'],
        ], [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'kontak_sales.regex' => 'Kontak sales hanya boleh berisi angka, spasi, + atau -.',
            'wilayah_asal.in' => 'Wilayah asal harus Nasional atau Internasional.',
        ], [
            'nama_penerbit' => 'Nama penerbit',
            'nama_sales' => 'Nama sales',
            'kontak_sales' => 'Kontak sales',
            'alamat' => 'Alamat',
            'wilayah_asal' => 'Wilayah asal',
        ]);
    }
}
