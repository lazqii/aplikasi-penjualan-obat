<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->has('search')) {
            $query->where('NmPelanggan', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('Alamat', 'LIKE', '%' . $request->search . '%');
        }

        $pelanggan = $query->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'KdPelanggan' => 'required|unique:pelanggans,KdPelanggan|max:10',
            'NmPelanggan' => 'required|max:50',
            'Alamat' => 'required',
            'Kota' => 'required',
            'NoTelp' => 'required|numeric',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'KdPelanggan' => 'required|max:10|unique:pelanggans,KdPelanggan,'.$id.',KdPelanggan',
            'NmPelanggan' => 'required|max:50',
            'Alamat' => 'required',
            'Kota' => 'required',
            'NoTelp' => 'required|numeric',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
            return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.index')->with('error', 'Gagal hapus! Pelanggan ini memiliki riwayat transaksi.');
        }
    }
}
