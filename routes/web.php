<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\PengaturanKlinikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/pasien', [PasienController::class, 'index']);
    Route::get('/antrian', [AntrianController::class, 'index']);

    Route::post('/antrian/{id}/status', [AntrianController::class, 'updateStatus']);
    Route::get('/pasien/{id}', [PasienController::class, 'show']);

    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit']);
    Route::post('/pasien/{id}/update', [PasienController::class, 'update']);
    Route::post('/pasien/{id}/delete', [PasienController::class, 'destroy']);

    Route::get('/jadwal-dokter', [JadwalDokterController::class, 'index']);
    Route::get('/jadwal-dokter/create', [JadwalDokterController::class, 'create']);
    Route::post('/jadwal-dokter/store', [JadwalDokterController::class, 'store']);
    Route::get('/jadwal-dokter/{id}/edit', [JadwalDokterController::class, 'edit']);
    Route::post('/jadwal-dokter/{id}/update', [JadwalDokterController::class, 'update']);
    Route::post('/jadwal-dokter/{id}/delete', [JadwalDokterController::class, 'destroy']);


    Route::get('/pengaturan-klinik', [PengaturanKlinikController::class, 'index']);
    Route::post('/pengaturan-klinik/update', [PengaturanKlinikController::class, 'update']);

    Route::get('/riwayat', [RiwayatController::class, 'index']);

    Route::get('/riwayat/export', [RiwayatController::class, 'export']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/export', [LaporanController::class, 'export']);

    Route::get('/laporan-bulanan', [LaporanController::class, 'bulanan']);

    Route::get('/antrian/{id}/rujuk', [AntrianController::class, 'formRujuk']);
    Route::post('/antrian/{id}/rujuk', [AntrianController::class, 'simpanRujuk']);
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);