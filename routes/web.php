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
use App\Http\Controllers\DokterController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    // =========================
    // PASIEN
    // =========================
    Route::get('/pasien', [PasienController::class, 'index']);
    Route::get('/pasien/{id}', [PasienController::class, 'show']);
    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit']);
    Route::post('/pasien/{id}/update', [PasienController::class, 'update']);
    Route::post('/pasien/{id}/delete', [PasienController::class, 'destroy']);

    // =========================
    // ANTRIAN
    // =========================
    Route::get('/antrian', [AntrianController::class, 'index']);
    Route::post('/antrian/{id}/status', [AntrianController::class, 'updateStatus']);

    Route::get('/antrian/{id}/rujuk', [AntrianController::class, 'formRujuk']);
    Route::post('/antrian/{id}/rujuk', [AntrianController::class, 'simpanRujuk']);

    // =========================
    // JADWAL DOKTER
    // =========================
    Route::get('/jadwal', [JadwalDokterController::class, 'index'])
        ->name('jadwal.index');

    Route::get('/jadwal/create', [JadwalDokterController::class, 'create'])
        ->name('jadwal.create');

    Route::post('/jadwal/store', [JadwalDokterController::class, 'store'])
        ->name('jadwal.store');

    Route::get('/jadwal/{id}/edit', [JadwalDokterController::class, 'edit'])
        ->name('jadwal.edit');

    Route::put('/jadwal/{id}/update', [JadwalDokterController::class, 'update'])
        ->name('jadwal.update');

    Route::post('/jadwal/{id}/delete', [JadwalDokterController::class, 'destroy'])
        ->name('jadwal.destroy');

    // =========================
    // PENGATURAN KLINIK
    // =========================
    Route::get('/pengaturan-klinik', [PengaturanKlinikController::class, 'index']);
    Route::post('/pengaturan-klinik/update', [PengaturanKlinikController::class, 'update']);

    // =========================
    // RIWAYAT
    // =========================
    Route::get('/riwayat', [RiwayatController::class, 'index']);
    Route::get('/riwayat/export', [RiwayatController::class, 'export']);

    // =========================
    // LAPORAN
    // =========================
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/export', [LaporanController::class, 'export']);
    Route::get('/laporan-bulanan', [LaporanController::class, 'bulanan']);

});

// =========================
// LOGIN
// =========================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// =========================
// API N8N
// =========================
Route::get(
    '/api/dokter-pendaftaran/{hari}',
    [JadwalDokterController::class, 'dokterPendaftaran']
);

// =========================
// MASTER DOKTER
// =========================
Route::resource('dokter', DokterController::class);