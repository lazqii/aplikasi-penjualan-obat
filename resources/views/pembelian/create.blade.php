@extends('layouts.app')

@section('title', 'Input Pembelian Baru')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Transaksi Pembelian</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf
            
            {{-- HEADER TRANSAKSI --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label">No Nota</label>
                    <input type="text" name="Nota" class="form-control" value="{{ $nota }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="TglNota" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Suplier</label>
                    <select name="KdSuplier" class="form-select" required>
                        <option value="">-- Pilih Suplier --</option>
                        @foreach($suplier as $sp)
                            <option value="{{ $sp->KdSuplier }}">{{ $sp->NmSuplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            {{-- KERANJANG BELANJA (DETAIL) --}}
            <h6 class="mb-3">Daftar Obat yang Dibeli</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="50%">Nama Obat</th>
                        <th width="30%">Jumlah</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="keranjang">
                    {{-- Baris pertama default --}}
                    <tr>
                        <td>
                            <select name="kd_obat[]" class="form-select" required>
                                <option value="">-- Pilih Obat --</option>
                                @foreach($obat as $ob)
                                    <option value="{{ $ob->KdObat }}">{{ $ob->NmObat }} (Stok: {{ $ob->Stok }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control" min="1" value="1" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-success btn-sm mb-3" id="add-row">
                <i class="bi bi-plus-circle"></i> Tambah Baris Obat
            </button>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT UNTUK NAMBAH BARIS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('keranjang');
        const addButton = document.getElementById('add-row');

        // Fungsi Tambah Baris
        addButton.addEventListener('click', function() {
            // Ambil baris pertama sebagai template
            let row = tableBody.rows[0].cloneNode(true);
            
            // Reset nilai input di baris baru
            let inputs = row.getElementsByTagName('input');
            for(let i=0; i<inputs.length; i++) { inputs[i].value = "1"; }
            
            let selects = row.getElementsByTagName('select');
            for(let i=0; i<selects.length; i++) { selects[i].value = ""; }

            // Aktifkan tombol hapus
            row.querySelector('.remove-row').disabled = false;

            // Masukkan ke tabel
            tableBody.appendChild(row);
        });

        // Fungsi Hapus Baris (Event Delegation)
        tableBody.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                // Jangan hapus jika cuma sisa 1 baris
                if (tableBody.rows.length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert("Minimal harus ada 1 obat!");
                }
            }
        });
    });
</script>
@endsection