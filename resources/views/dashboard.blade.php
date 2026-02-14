@extends('layouts.app')

@section('title', 'Dashboard Apotek')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="mb-3">👋 Selamat Datang, Admin!</h4>
        <p class="text-muted">Berikut adalah laporan harian apotek Anda tanggal {{ date('d F Y') }}</p>
    </div>
</div>

{{-- 4 KARTU STATISTIK UTAMA --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Omset Hari Ini</h6>
                        <h3 class="fw-bold mt-2 mb-0">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-wallet2 fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Transaksi</h6>
                        <h3 class="fw-bold mt-2 mb-0">{{ $transaksiHariIni }}</h3>
                    </div>
                    <i class="bi bi-receipt fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Obat Terjual</h6>
                        <h3 class="fw-bold mt-2 mb-0">{{ $itemTerjualHariIni }} <small class="fs-6">pcs</small></h3>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Pelanggan</h6>
                        <h3 class="fw-bold mt-2 mb-0">{{ $totalPelanggan }}</h3>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- TABEL STOK MENIPIS (PENTING!) --}}
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> Peringatan Stok Menipis (<= 10)</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th class="text-center">Sisa Stok</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stokMenipis as $item)
                        <tr>
                            <td>{{ $item->NmObat }}</td>
                            <td class="text-center fw-bold text-danger">{{ $item->Stok }}</td>
                            <td class="text-end">
                                {{-- Tombol Restock mengarah ke Pembelian --}}
                                <a href="{{ route('pembelian.create') }}" class="btn btn-sm btn-outline-danger">Restock</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Aman! Tidak ada stok yang menipis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- AKSES CEPAT --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-light">
                <h6 class="mb-0">Akses Cepat</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('penjualan.create') }}" class="btn btn-lg btn-success">
                    <i class="bi bi-cart-plus me-2"></i> KASIR BARU
                </a>
                <a href="{{ route('obat.create') }}" class="btn btn-lg btn-outline-primary">
                    <i class="bi bi-capsule me-2"></i> Tambah Obat
                </a>
                <a href="{{ route('pembelian.create') }}" class="btn btn-lg btn-outline-dark">
                    <i class="bi bi-truck me-2"></i> Input Pembelian (Restock)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection