<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
    Route::get('/area', [MejaController::class, 'index'])->name('area.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('fasilitas', FasilitasController::class)
            ->parameters(['fasilitas' => 'fasilitas'])
            ->except(['index', 'show']);

        Route::resource('area', MejaController::class)
            ->parameters(['area' => 'meja'])
            ->except(['index', 'show']);
    });
});

