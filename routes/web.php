<?php

use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/penerbit');

Route::resource('penerbit', PenerbitController::class)->except('show');
