<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Obat;
use App\Models\Pelanggan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        //Omset Hari Ini
        $omsetHariIni = PenjualanDetail::whereHas('penjualan', function($q) use ($today) {
            $q->whereDate('TglNota', $today);
        })->get()->sum(function($detail) {
            return $detail->jumlah * $detail->obat->HargaJual;
        });

        // Jumlah Transaksi Hari Ini
        $transaksiHariIni = Penjualan::whereDate('TglNota', $today)->count();

        // Jumlah Item Obat Terjual Hari Ini
        $itemTerjualHariIni = PenjualanDetail::whereHas('penjualan', function($q) use ($today) {
            $q->whereDate('TglNota', $today);
        })->sum('Jumlah');

        // Data Stok Menipis (Misal stok di bawah 10)
        $stokMenipis = Obat::where('Stok', '<=', 10)->orderBy('Stok', 'asc')->limit(5)->get();

        // Total Pelanggan
        $totalPelanggan = Pelanggan::count();

        return view('dashboard', compact(
            'omsetHariIni', 
            'transaksiHariIni', 
            'itemTerjualHariIni', 
            'stokMenipis',
            'totalPelanggan'
        ));
    }
}