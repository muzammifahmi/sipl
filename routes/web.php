<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PreprocessingController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/reports/export', [ReportController::class, 'export'])->middleware('auth')->name('reports.export');
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');
Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::post('/mahasiswa/preprocess', [MahasiswaController::class, 'preprocess'])->name('mahasiswa.preprocess');
Route::middleware(['auth'])->group(function () {

    // Route Khusus untuk Data Mentah
    Route::get('/preprocessing/data-mentah', [PreprocessingController::class, 'indexRaw'])
        ->name('preprocessing.raw');

    // Route Khusus untuk Data Bersih
    Route::get('/preprocessing/data-bersih', [PreprocessingController::class, 'indexClean'])
        ->name('preprocessing.clean');

    // (Opsional) Jika nanti Anda butuh fitur delete/edit, baru tambahkan resource di bawah ini:
    // Route::resource('preprocessing', PreprocessingController::class)->except(['index', 'show']);
});
require __DIR__ . '/auth.php';
