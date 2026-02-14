<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SuplierController;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
// Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
// Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');


Route::resource('obat', ObatController::class);

// Route::get('/penjualan/{id}/cetak', function ($id) {
//     $penjualan = Penjualan::with(['pelanggan', 'details.obat'])->findOrFail($id);
//     return view('penjualan.cetak', compact('penjualan'));
// })->name('penjualan.cetak');

Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
Route::resource('penjualan', PenjualanController::class);

Route::resource('pembelian', PembelianController::class);

Route::resource('pelanggan', PelangganController::class);
Route::resource('suplier', SuplierController::class);