@extends('layouts.app') 
@section('title', 'Data Penjualan') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"></h5>
            <a href="{{ route('pembelian.create') }}" class="btn btn-light btn-sm">Tambah Transaksi</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No Nota</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Suplier</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembelian as $pb)
                    <tr>
                        <td>{{ $pb->Nota }}</td>
                        <td>{{ $pb->TglNota }}</td>
                        <td>{{ $pb->suplier->NmSuplier }}</td>
                        <td>{{ number_format($pb->Diskon) }}</td>
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
                            <a href="{{ route('pembelian.show', $pb->Nota) }}" class="btn btn-sm btn-info text-white">
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