<?php

use App\Http\Controllers\AksesNaskahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisNaskahController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\NaskahController;
use App\Http\Controllers\NomorController;
use App\Http\Controllers\PlhController;
use App\Http\Controllers\WewenangController;

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(['role:user'])->group(function () {
    Route::get('/user-nomor', [NomorController::class, 'userNomor']);
    Route::get('/user-nomor-selesai', [NomorController::class, 'userNomorSelesai']);
    Route::get('/user-arsip', [NomorController::class, 'arsipNaskah']);
    Route::get('/akes-naskah', [AksesNaskahController::class, 'index']);
    Route::get('/store', [NomorController::class, 'getNumber']);
    Route::get('/user-klasifikasi', [KlasifikasiController::class, 'getAll']);
    Route::post('/nomor', [NomorController::class, 'store'])->middleware('checktime');
    Route::post('/update-file/{id}', [NomorController::class, 'updateFile']);
});





Route::middleware(['role:admin'])->group(function () {

    Route::get('/naskah', [NaskahController::class, 'index']);
    Route::post('/naskah', [NaskahController::class, 'store']);
    Route::put('/naskah/{id}', [NaskahController::class, 'update']);
    Route::delete('/naskah/{id}', [NaskahController::class, 'destroy']);

    Route::get('/jenis-naskah', [JenisNaskahController::class, 'index']);
    Route::post('/jenis-naskah', [JenisNaskahController::class, 'store']);
    Route::put('/jenis-naskah/{id}', [JenisNaskahController::class, 'update']);
    Route::delete('/jenis-naskah/{id}', [JenisNaskahController::class, 'destroy']);


    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    Route::put('/jabatan/{id}', [JabatanController::class, 'update']);
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy']);


    Route::get('/klasifikasi', [KlasifikasiController::class, 'index']);
    Route::post('/klasifikasi', [KlasifikasiController::class, 'store']);
    Route::put('/klasifikasi/{id}', [KlasifikasiController::class, 'update']);
    Route::delete('/klasifikasi/{id}', [KlasifikasiController::class, 'destroy']);



    Route::get('/wewenang', [WewenangController::class, 'index']);
    Route::post('/wewenang', [WewenangController::class, 'store']);
    Route::put('/wewenang/{id}', [WewenangController::class, 'update']);
    Route::delete('/wewenang/{id}', [WewenangController::class, 'destroy']);

    Route::get('/plh', [PlhController::class, 'index']);
    Route::post('/plh', [PlhController::class, 'store']);
    Route::put('/plh/{id}', [PlhController::class, 'update']);
    Route::delete('/plh/{id}', [PlhController::class, 'destroy']);

    Route::get('/nomor', [NomorController::class, 'index']);
    Route::get('/nomor-selesai', [NomorController::class, 'nomorSelesai']);
    Route::get('/arsip-naskah', [NomorController::class, 'arsipNaskah']);
    Route::put('/nomor/{id}', [NomorController::class, 'update']);
    Route::delete('/nomor/{id}', [NomorController::class, 'destroy']);


    Route::put('/update-status/{id}', [NomorController::class, 'updateStatus']);
    Route::put('/update-tipe/{id}', [NomorController::class, 'updateTipe']);
});
















Route::post('/login', [AuthController::class, 'loginWithExternalApi']);
