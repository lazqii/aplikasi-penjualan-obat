<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Suplier;

class ObatController extends Controller
{
    //
    public function index()
    {
        $obat = Obat::all();

        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        $suplier = Suplier::all();
        return view('obat.create', compact('suplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'KdObat' => 'required|unique:obats,KdObat|max:10',
            'NmObat' => 'required|max:50',
            'Jenis' => 'required',
            'Satuan' => 'required',
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
            'Stok' => 'required|numeric',
            'KdSuplier' => 'required|exists:supliers,KdSuplier',
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $suplier = Suplier::all();
        return view('obat.edit', compact('obat', 'suplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'KdObat' => 'required|max:10|unique:obats,KdObat,'.$id.',KdObat',
            'NmObat' => 'required|max:50',
            'Jenis' => 'required',
            'Satuan' => 'required',
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
            'Stok' => 'required|numeric',
            'KdSuplier' => 'required|exists:supliers,KdSuplier',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil dihapus!');
    }
}
