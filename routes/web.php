<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\BukukasController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\LoginController;

//Route::get('forgot-password', [LoginController::class, 'showLinkRequestForm'])->name('password.request');
//Route::post('forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
//Route::get('reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
//Route::post('reset-password', [LoginController::class, 'reset'])->name('password.update');

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('/user', UserController::class);
});

Route::group(['middleware' => ['role:admin,owner']], function () {
    Route::resource('/mobil', MobilController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf/{bulan}/{tahun}', [LaporanController::class, 'buatPDF'])->name('laporan.buatPDF');
    //Route::get('/laporan/harian', [LaporanController::class, 'laporanHarian'])->name('laporan.harian');
    //Route::get('/laporan/harian/pdf/{tanggal}', [LaporanController::class, 'buatPDFHarian'])->name('laporan.buatPDFHarian');
});

Route::group(['middleware' => ['role:admin,owner,user']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('bukukas', BukukasController::class)->only([
        'index'
    ]);
    Route::post('/bukukas/masuk', [BukukasController::class, 'storeMasuk'])->name('bukukas.storeMasuk');
    Route::post('/bukukas/keluar', [BukukasController::class, 'storeKeluar'])->name('bukukas.storeKeluar');
    Route::delete('/bukukas/{bukukas}', [BukukasController::class, 'destroy'])->name('bukukas.destroy');

    Route::resource('profil', ProfilController::class)->only(['index', 'edit', 'update']);

    Route::get('profil/change-password', [ProfilController::class, 'changePasswordForm'])->name('profil.changePasswordForm');
    Route::post('profil/change-password', [ProfilController::class, 'changePassword'])->name('profil.changePassword');
});

// Routes publik
Route::get('/', function () {
    return view('home.home');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

