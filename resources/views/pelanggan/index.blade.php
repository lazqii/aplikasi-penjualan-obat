@extends('layouts.app') 
@section('title', 'Data Pelanggan') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"></h5>
            <a href="#" class="btn btn-light btn-sm">Tambah Pelanggan</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $plg)
                    <tr>
                        <td>{{ $plg->KdPelanggan }}</td>
                        <td>{{ $plg->NmPelanggan }}</td>
                        <td>{{ $plg->Alamat }}</td>
                        <td>{{ $plg->Kota }}</td>
                        <td>{{ $plg->NoTelp }}</td>
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
                        <td colspan="5" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection