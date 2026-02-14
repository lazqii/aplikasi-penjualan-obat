@extends('layouts.app') 
@section('title', 'Data Obat') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"></h5>
            <div class="d-flex">
                {{-- Form Pencarian --}}
                <form action="{{ route('obat.index') }}" method="GET" class="d-flex me-2">
                    <input type="text" 
                        id="keyword"
                        name="search" 
                        class="form-control form-control-sm me-2" 
                        placeholder="Cari Kode/Nama..." 
                        value="{{ request('search') }}"
                        autocomplete="off"> 
                </form>
           {{-- Tombol Tambah --}}
        <a href="{{ route('obat.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Obat
        </a>
            </div>
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
                <tbody id="tabel-obat">
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
                            <a href="{{ route('obat.edit', $obt->KdObat) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('obat.destroy', $obt->KdObat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')"> 
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
            <script>
                // 1. Tangkap elemen input dan tabel
                const keyword = document.getElementById('keyword');
                const tabelObat = document.getElementById('tabel-obat');

                // 2. Pasang 'telinga' untuk mendengar ketikan user
                keyword.addEventListener('keyup', function() {
                    
                    // Ambil apa yang diketik
                    let value = keyword.value;

                    // 3. Kirim permintaan ke Controller secara diam-diam (Fetch API)
                    // Kita nembak ke URL route index + ?search=katakunci
                    fetch("{{ route('obat.index') }}?search=" + value)
                        .then(response => response.text()) // Ubah respon jadi teks HTML
                        .then(html => {
                            // 4. Teknik Parsing: Ubah teks HTML menjadi dokumen virtual
                            let parser = new DOMParser();
                            let doc = parser.parseFromString(html, 'text/html');

                            // 5. Ambil <tbody> dari dokumen virtual itu
                            let newTbody = doc.getElementById('tabel-obat');

                            // 6. Tukar <tbody> lama dengan yang baru
                            tabelObat.innerHTML = newTbody.innerHTML;
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>
        </div>
    </div>
@endsection