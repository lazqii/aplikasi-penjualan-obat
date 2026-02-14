<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $pembelian = Pembelian::with('suplier')->get();
        return view('pembelian.index', compact('pembelian'));
    }

    public function show($id) {
    $pembelian = Pembelian::with(['suplier', 'details.obat'])->findOrFail($id);
    return view('pembelian.show', compact('pembelian'));
}
}
