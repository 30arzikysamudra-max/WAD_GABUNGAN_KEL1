<?php

use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/penerbit', [PenerbitController::class, 'index'])->name('penerbit.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('penerbit', PenerbitController::class)->except(['index', 'show']);
    });

    Route::get('/penerbit/{penerbit}', [PenerbitController::class, 'show'])
        ->whereNumber('penerbit')
        ->name('penerbit.show');
});

