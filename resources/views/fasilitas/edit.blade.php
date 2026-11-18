@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <h2>Edit Fasilitas</h2>

    @include('fasilitas._form', [
        'action'    => route('fasilitas.update', $fasilitas),
        'method'    => 'PUT',
        'tombol'    => 'Perbarui',
        'fasilitas' => $fasilitas,
    ])
@endsection

