<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
// Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::resource('pembelian', PembelianController::class);
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
