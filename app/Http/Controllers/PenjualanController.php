<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    //
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->get(); 
        return view('penjualan.index', compact('penjualan'));
    }

    public function show($id) {
        $penjualan = Penjualan::with(['pelanggan', 'details.obat'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request){
            $penjualan = Penjualan::create([
                'Nota' => $request->nota,
                'TglNota' => $request->tgl_nota,
                'KdPelanggan' => $request->kd_pelanggan,
                'Diskon' => $request->diskon
            ]);

            foreach ($request->items as $item){
                PenjualanDetail::create([
                    'Nota' => $penjualan->Nota,
                    'KdObat' => $item['kdobat'],
                    'Jumlah' => $item['jumlah']
                ]);

                $obat = Obat::findOrFail($item['kd_obat']);

                if ($obat->Stok < $item['jumlah']){
                    throw new \Exception("Stok {$obat->NmObat} tidak mencukupi!");
                }

                $obat->decrement('Stok', $item['jumlah']);
            }
        });

        return redirect()->back()->with('success', 'Transaksi berhasil!');

    }
}
