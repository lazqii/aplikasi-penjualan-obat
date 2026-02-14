@extends('layouts.app') 
@section('title', 'Data Obat') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"></h5>
            <a href="#" class="btn btn-light btn-sm">Tambah Obat</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $obt)
                    <tr>
                        <td>{{ $obt->KdObat }}</td>
                        <td>{{ $obt->NmObat }}</td>
                        <td>{{ $obt->Jenis }}</td>
                        <td>{{ $obt->Satuan }}</td>
                        <td>{{ $obt->HargaBeli }}</td>
                        <td>{{ $obt->HargaJual }}</td>
                        <td>{{ $obt->Stok }}</td>
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection