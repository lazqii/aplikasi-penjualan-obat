@extends('layouts.app')
@section('title', 'Detail Penjualan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Nota: {{ $penjualan->Nota }}</h5>
        <a href="{{ route('penjualan.cetak', $penjualan->Nota) }}" target="_blank" class="btn btn-light btn-sm">
            <i class="bi bi-printer"></i> Cetak Nota
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td width="120"><strong>Pelanggan</strong></td>
                        <td>: {{ $penjualan->pelanggan->NmPelanggan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: {{ date('d F Y', strtotime($penjualan->TglNota)) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th class="text-end">Harga Satuan</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($penjualan->details as $index => $detail)
                @php 
                    // Hitung subtotal per baris (Harga Jual saat ini * Jumlah)
                    // Catatan: Idealnya harga disimpan di tabel detail agar tidak berubah jika harga master naik
                    // Tapi untuk ujian, ambil dari master obat saja dulu
                    $subtotal = $detail->obat->HargaJual * $detail->Jumlah;
                    $grandTotal += $subtotal;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->obat->NmObat }}</td>
                    <td class="text-end">Rp {{ number_format($detail->obat->HargaJual, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $detail->Jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <td colspan="4" class="text-end fw-bold">TOTAL BAYAR</td>
                    <td class="text-end fw-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-3">
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection