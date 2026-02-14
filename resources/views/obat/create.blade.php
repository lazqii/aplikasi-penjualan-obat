@extends('layouts.app')

@section('title', 'Tambah Data Obat')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Tambah Obat</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('obat.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="KdObat" class="form-label">Kode Obat</label>
                    <input type="text" name="KdObat" class="form-control" required placeholder="Contoh: OB001">
                </div>
                <div class="col-md-6">
                    <label for="NmObat" class="form-label">Nama Obat</label>
                    <input type="text" name="NmObat" class="form-control" required placeholder="Contoh: Paracetamol">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Jenis" class="form-label">Jenis</label>
                    <input type="text" name="Jenis" class="form-control" required placeholder="Contoh: Obat Bebas">
                </div>
                <div class="col-md-6">
                    <label for="Satuan" class="form-label">Satuan</label>
                    <input type="text" name="Satuan" class="form-control" required placeholder="Contoh: Strip/Botol">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="HargaBeli" class="form-label">Harga Beli</label>
                    <input type="number" name="HargaBeli" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="HargaJual" class="form-label">Harga Jual</label>
                    <input type="number" name="HargaJual" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="Stok" class="form-label">Stok Awal</label>
                    <input type="number" name="Stok" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="KdSuplier" class="form-label">Suplier</label>
                <select name="KdSuplier" class="form-select" required>
                    <option value="">-- Pilih Suplier --</option>
                    @foreach($suplier as $sp)
                        <option value="{{ $sp->KdSuplier }}">{{ $sp->NmSuplier }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection