<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\MatakuliahController;

Route::get('/', function () {
    return view ('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat datang di Website Kampus PCR';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
});

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya : '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'Nim saya : '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/matakuliah/{param1}', [MatakuliahController::class, 'show']);
Route::get('/matakuliah/show/{param1}', [MatakuliahController::class, 'show']);
