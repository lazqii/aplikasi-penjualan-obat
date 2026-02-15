<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SuplierController;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
// Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
// Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');


Route::resource('obat', ObatController::class);

// Route::get('/penjualan/{id}/cetak', function ($id) {
//     $penjualan = Penjualan::with(['pelanggan', 'details.obat'])->findOrFail($id);
//     return view('penjualan.cetak', compact('penjualan'));
// })->name('penjualan.cetak');

// Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
// Route::resource('penjualan', PenjualanController::class);

// Route::resource('pembelian', PembelianController::class);

// Route::resource('pelanggan', PelangganController::class);
// Route::resource('suplier', SuplierController::class);

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['ceklevel:admin'])->group(function () {
        Route::resource('obat', ObatController::class);
        Route::resource('suplier', SuplierController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('pembelian', PembelianController::class);
        
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    });

    Route::middleware(['ceklevel:admin,kasir'])->group(function () {
        Route::resource('penjualan', PenjualanController::class)->except(['destroy']);
        Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
    });

});