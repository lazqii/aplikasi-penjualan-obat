<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $pembelian = Pembelian::with('suplier')->latest()->get();
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $suplier = Suplier::all();
        $obat = Obat::all();
        
        // Generate No Nota
        // Format: PB + TahunBulanHari + RandomAngka (Contoh: PB2026021401)
        $today = date('Ymd');
        $nota = 'PB' . $today . rand(10, 99);

        return view('pembelian.create', compact('suplier', 'obat', 'nota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nota' => 'required|unique:pembelians,Nota',
            'TglNota' => 'required|date',
            'KdSuplier' => 'required',
            'kd_obat' => 'required|array',
            'kd_obat.*' => 'required',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|numeric|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                $pembelian = Pembelian::create([
                    'Nota' => $request->Nota,
                    'TglNota' => $request->TglNota,
                    'KdSuplier' => $request->KdSuplier,
                    'Diskon' => 0,
                ]);

                foreach ($request->kd_obat as $index => $kdObat) {
                    $jumlah = $request->jumlah[$index];

                    // Simpan ke Detail
                    PembelianDetail::create([
                        'Nota' => $pembelian->Nota,
                        'KdObat' => $kdObat,
                        'Jumlah' => $jumlah
                    ]);

                    // UPDATE STOK
                    Obat::where('KdObat', $kdObat)->increment('Stok', $jumlah);
                }
            });

            return redirect()->route('pembelian.index')->with('success', 'Transaksi Pembelian Berhasil! Stok Bertambah.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id) {
        $pembelian = Pembelian::with(['suplier', 'details.obat'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }
}
