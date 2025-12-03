<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\PegawaiController;

use App\Http\Controllers\MatakuliahController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\QuestionController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PelangganController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\MultipleuploadsController;

use App\Http\Controllers\Controller;



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

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/matakuliah/{param1}', [MatakuliahController::class, 'show']);
Route::get('/matakuliah/show/{param1}', [MatakuliahController::class, 'show']);


Route::get('/home', [HomeController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::get('dashboard',[DashboardController::class , 'index'])
        ->name('dashboard');



Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);



Route::resource('user', App\Http\Controllers\UserController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::resource('/user', UserController::class);

Route::get('/multipleuploads', 'MultipleuploadsController@index')->name('uploads');
Route::post('/save','MultipleuploadsController@store')->name('uploads.store');


Route::middleware('guest')->group(function () {
    // Halaman Form Login
    Route::get('/auth', [AuthController::class, 'index'])->name('login');

    // Proses Submit Login
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.process');

    // Halaman Depan/Landing Page
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    // Logout (Dapat diakses oleh semua user yang sudah login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- Rute User Biasa ---

    // Halaman Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contoh Fitur User Biasa (e.g., Kirim Pertanyaan)
    Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');

    // Rute /home (Mungkin diarahkan ke Dashboard/Landing Page user login)
    Route::get('/home', [HomeController::class, 'index']);

    // Rute yang dilindungi oleh Middleware 'role:admin'
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // CRUD User (admin/user/*)
        Route::resource('user', UserController::class);

        // CRUD Pelanggan (admin/pelanggan/*)
        Route::resource('pelanggan', PelangganController::class);
    });
});


Route::get('/multipleuploads', [MultipleuploadsController::class, 'index'])->name('uploads');
Route::post('/save',[MultipleuploadsController::class, 'store'])->name('uploads.store');
