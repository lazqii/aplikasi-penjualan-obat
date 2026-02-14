@extends('layouts.app') 
@section('title', 'Data Penjualan') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"></h5>
            <a href="#" class="btn btn-light btn-sm">Tambah Transaksi</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No Nota</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualan as $pj)
                    <tr>
                        <td>{{ $pj->Nota }}</td>
                        <td>{{ $pj->TglNota }}</td>
                        <td>{{ $pj->pelanggan->NmPelanggan }}</td>
                        <td>{{ number_format($pj->Diskon) }}</td>
                        <td>
                            
                            <a href="#" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('penjualan.show', $pj->Nota) }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>
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