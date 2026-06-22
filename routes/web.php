<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [DashboardController::class, 'index']);
Route::get('/pasien', [PasienController::class, 'index']);
Route::get('/antrian', [AntrianController::class, 'index']);

Route::post('/antrian/{id}/status', [AntrianController::class, 'updateStatus']);
Route::get('/pasien/{id}', [PasienController::class, 'show']);

Route::get('/pasien/{id}/edit', [PasienController::class, 'edit']);
Route::post('/pasien/{id}/update', [PasienController::class, 'update']);

Route::post('/pasien/{id}/delete', [PasienController::class, 'destroy']);






