@extends('layouts.app')
@section('title', 'Detail Pembelian')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Nota: {{ $pembelian->Nota }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Suplier:</strong> {{ $pembelian->suplier->NmSuplier }}</p>
                <p><strong>Tanggal:</strong> {{ $pembelian->TglNota }}</p>
            </div>
            <div class="col-md-6 text-end">
                <p><strong>Diskon:</strong> Rp {{ number_format($pembelian->Diskon) }}</p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($pembelian->details as $detail)
                @php 
                    $subtotal = $detail->obat->HargaBeli * $detail->Jumlah; 
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $detail->obat->NmObat }}</td>
                    <td>Rp {{ number_format($detail->obat->HargaBeli) }}</td>
                    <td>{{ $detail->Jumlah }}</td>
                    <td>Rp {{ number_format($subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total Bayar (Setelah Diskon)</th>
                    <th>Rp {{ number_format($total - $pembelian->Diskon) }}</th>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection