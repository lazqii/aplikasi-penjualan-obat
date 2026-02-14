@extends('layouts.app')
@section('title', 'Edit Suplier')

@section('content')
<div class="card shadow-sm" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Form Edit Suplier</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('suplier.update', $suplier->KdSuplier) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Kode Suplier</label>
                <input type="text" name="KdSuplier" class="form-control" value="{{ $suplier->KdSuplier }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text" name="NmSuplier" class="form-control" value="{{ $suplier->NmSuplier }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="Alamat" class="form-control" rows="3" required>{{ $suplier->Alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="Kota" class="form-control" value="{{ $suplier->Kota }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="number" name="NoTelp" class="form-control" value="{{ $suplier->NoTelp }}" required>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection