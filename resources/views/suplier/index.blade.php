@extends('layouts.app')
@section('title', 'Data Suplier')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Suplier</h5>
        <div class="d-flex">
            {{-- Form Pencarian --}}
            <form action="{{ route('suplier.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="search" class="form-control form-control-sm me-2" 
                       placeholder="Cari Nama/Alamat..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-light btn-sm"><i class="bi bi-search"></i></button>
            </form>
            
            <a href="{{ route('suplier.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suplier as $sp)
                <tr>
                    <td>{{ $sp->KdSuplier }}</td>
                    <td>{{ $sp->NmSuplier }}</td>
                    <td>{{ $sp->Alamat }}</td>
                    <td>{{ $sp->NoTelp }}</td>
                    <td>
                        <a href="{{ route('suplier.edit', $sp->KdSuplier) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('suplier.destroy', $sp->KdSuplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus suplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection