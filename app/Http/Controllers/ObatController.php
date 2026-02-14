<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Suplier;

class ObatController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Obat::with('suplier');

    // input search
    if ($request->has('search')) {
        $search = $request->search;
        
    // filter kode atau nama obat
        $query->where(function($q) use ($search) {
            $q->where('KdObat', 'LIKE', '%' . $search . '%')
              ->orWhere('NmObat', 'LIKE', '%' . $search . '%');
        });
    }

    $obat = $query->get();

    return view('obat.index', compact('obat'));
}

    public function create()
    {
        $suplier = Suplier::all();
        return view('obat.create', compact('suplier'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['HargaBeli'] = str_replace('.', '', $request->HargaBeli);
        $data['HargaJual'] = str_replace('.', '', $request->HargaJual);

        $request->merge($data);
        $request->validate([
            'KdObat' => 'required|unique:obats,KdObat|max:10',
            'NmObat' => 'required|max:50',
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
        ]);

        Obat::create($data);

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
        $data = $request->all();

        $data['HargaBeli'] = str_replace('.', '', $request->HargaBeli);
        $data['HargaJual'] = str_replace('.', '', $request->HargaJual);

        $request->merge($data);

        $request->validate([
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($data);

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil dihapus!');
    }
}
