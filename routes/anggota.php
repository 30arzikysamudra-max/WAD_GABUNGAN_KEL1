<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::redirect('/anggota', '/members')->name('anggota.index');
    Route::get('/members/{member}/card', [MemberController::class, 'card'])->name('members.card');

    Route::middleware('role:admin')->group(function () {
        Route::post('/members', [MemberController::class, 'store'])->name('members.store');
        Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    });
});

