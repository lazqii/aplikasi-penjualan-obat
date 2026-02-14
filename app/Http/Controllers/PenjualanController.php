<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Obat;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    //
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->latest()->get(); 
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $obat = Obat::where('Stok', '>', 0)->get();

        // Generate No Nota (PJ + Timestamp)
        $nota = 'PJ' . date('YmdHis');

        return view('penjualan.create', compact('pelanggan', 'obat', 'nota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nota' => 'required|unique:penjualans,Nota',
            'TglNota' => 'required|date',
            'KdPelanggan' => 'required',
            'kd_obat' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $penjualan = Penjualan::create([
                    'Nota' => $request->Nota,
                    'TglNota' => $request->TglNota,
                    'KdPelanggan' => $request->KdPelanggan,
                    'Diskon' => 0, 
                ]);

                foreach ($request->kd_obat as $index => $kdObat) {
                    $jumlah = $request->jumlah[$index];
                    
                    // cek stok
                    $obat = Obat::find($kdObat);
                    if ($obat->Stok < $jumlah) {
                        throw new \Exception("Stok {$obat->NmObat} tidak cukup! (Sisa: {$obat->Stok})");
                    }

                    PenjualanDetail::create([
                        'Nota' => $penjualan->Nota,
                        'KdObat' => $kdObat,
                        'Jumlah' => $jumlah
                    ]);

                    $obat->decrement('Stok', $jumlah);
                }
            });

            return redirect()->route('penjualan.index')->with('success', 'Transaksi Penjualan Berhasil!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $penjualan = Penjualan::with('details')->findOrFail($id);

            foreach ($penjualan->details as $detail) {
                Obat::where('KdObat', $detail->KdObat)
                    ->increment('Stok', $detail->Jumlah);
            }

            $penjualan->details()->delete();
            $penjualan->delete();

            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dihapus dan Stok telah dikembalikan!');

        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function show($id) {
        $penjualan = Penjualan::with(['pelanggan', 'details.obat'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function cetak($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'details.obat'])->findOrFail($id);
        return view('penjualan.cetak', compact('penjualan'));
    }

}
