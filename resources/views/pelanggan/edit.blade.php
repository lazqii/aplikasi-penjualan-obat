@extends('layouts.app')
@section('title', 'Edit Pelanggan')

@section('content')
<div class="card shadow-sm" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Form Edit Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.update', $pelanggan->KdPelanggan) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Kode Pelanggan</label>
                <input type="text" name="KdPelanggan" class="form-control" value="{{ $pelanggan->KdPelanggan }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="NmPelanggan" class="form-control" value="{{ $pelanggan->NmPelanggan }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="Alamat" class="form-control" rows="3" required>{{ $pelanggan->Alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="Kota" class="form-control" value="{{ $pelanggan->Kota }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="number" name="NoTelp" class="form-control" value="{{ $pelanggan->NoTelp }}" required>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection