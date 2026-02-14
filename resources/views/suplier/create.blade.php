@extends('layouts.app')
@section('title', 'Tambah Suplier')

@section('content')
<style>
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }
        main, .main-content {
        overflow-y: auto !important;
        height: auto !important;
    }
</style>
<div class="card shadow-sm" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Tambah Suplier</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('suplier.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Suplier</label>
                <input type="text" name="KdSuplier" class="form-control" placeholder="Contoh: SP001" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text" name="NmSuplier" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="Alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="Kota" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="number" name="NoTelp" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection