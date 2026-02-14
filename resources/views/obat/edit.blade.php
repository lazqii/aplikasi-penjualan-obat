@extends('layouts.app')

@section('title', 'Edit Data Obat')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Form Edit Obat</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('obat.update', $obat->KdObat) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="KdObat" class="form-label">Kode Obat</label>
                    <input type="text" name="KdObat" class="form-control" value="{{ $obat->KdObat }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="NmObat" class="form-label">Nama Obat</label>
                    <input type="text" name="NmObat" class="form-control" value="{{ $obat->NmObat }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Jenis" class="form-label">Jenis</label>
                    <input type="text" name="Jenis" class="form-control" value="{{ $obat->Jenis }}" required>
                </div>
                <div class="col-md-6">
                    <label for="Satuan" class="form-label">Satuan</label>
                    <input type="text" name="Satuan" class="form-control" value="{{ $obat->Satuan }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="HargaBeli" class="form-label">Harga Beli</label>
                    <input type="text" 
                        class="form-control rupiah" 
                        name="HargaBeli" 
                        value="{{ number_format($obat->HargaBeli, 0, ',', '.') }}" 
                        required>
                </div>
                <div class="col-md-4">
                    <label for="HargaJual" class="form-label">Harga Jual</label>
                    <input type="text" name="HargaJual" class="form-control rupiah" value="{{ number_format($obat->HargaJual, 0, ',', '.') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="Stok" class="form-label">Stok</label>
                    <input type="number" name="Stok" class="form-control" value="{{ $obat->Stok }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="KdSuplier" class="form-label">Suplier</label>
                <select name="KdSuplier" class="form-select" required>
                    <option value="">-- Pilih Suplier --</option>
                    @foreach($suplier as $sp)
                        <option value="{{ $sp->KdSuplier }}" {{ $obat->KdSuplier == $sp->KdSuplier ? 'selected' : '' }}>
                            {{ $sp->NmSuplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection