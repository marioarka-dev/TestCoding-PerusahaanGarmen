<?php

use App\Http\Controllers\SuratJalanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('surat-jalan.index');
});

Route::resource('surat-jalan', SuratJalanController::class);
