<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Suplier::query();

        if ($request->has('search')) {
            $query->where('NmSuplier', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('Alamat', 'LIKE', '%' . $request->search . '%');
        }

        $suplier = $query->get();
        return view('suplier.index', compact('suplier'));
    }

    public function create()
    {
        return view('suplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'KdSuplier' => 'required|unique:supliers,KdSuplier|max:10',
            'NmSuplier' => 'required|max:50',
            'Alamat' => 'required',
            'NoTelp' => 'required|numeric',
        ]);

        Suplier::create($request->all());

        return redirect()->route('suplier.index')->with('success', 'Data Suplier berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('suplier.edit', compact('suplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'KdSuplier' => 'required|max:10|unique:supliers,KdSuplier,'.$id.',KdSuplier',
            'NmSuplier' => 'required|max:50',
            'Alamat' => 'required',
            'NoTelp' => 'required|numeric',
        ]);

        $suplier = Suplier::findOrFail($id);
        $suplier->update($request->all());

        return redirect()->route('suplier.index')->with('success', 'Data Suplier berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $suplier = Suplier::findOrFail($id);
            $suplier->delete();
            return redirect()->route('suplier.index')->with('success', 'Data Suplier berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('suplier.index')->with('error', 'Gagal hapus! Suplier ini memiliki riwayat transaksi.');
        }
    }
}