<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('buku', BukuController::class)->except(['index', 'show']);
    });
});

