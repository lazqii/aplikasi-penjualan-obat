@extends('layouts.app')

@section('title', 'Transaksi Penjualan')

@section('content')
<style>
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }
        main, .main-content {
        overflow-y: auto !important;
        height: auto !important;
    }
</style>
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Kasir Penjualan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            
            {{-- BAGIAN 1: DATA TRANSAKSI --}}
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
                    <label class="form-label">Pelanggan</label>
                    <select name="KdPelanggan" class="form-select" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $pl)
                            <option value="{{ $pl->KdPelanggan }}">{{ $pl->NmPelanggan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            {{-- BAGIAN 2: KERANJANG BELANJA --}}
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="40%">Nama Obat</th>
                        <th width="20%">Harga</th>
                        <th width="15%">Jumlah</th>
                        <th width="20%">Subtotal</th>
                        <th width="5%">Hapus</th>
                    </tr>
                </thead>
                <tbody id="keranjang">
                    {{-- Baris Pertama --}}
                    <tr>
                        <td>
                            <select name="kd_obat[]" class="form-select obat-select" required onchange="updateHarga(this)">
                                <option value="" data-harga="0">-- Pilih Obat --</option>
                                @foreach($obat as $ob)
                                    <option value="{{ $ob->KdObat }}" data-harga="{{ $ob->HargaJual }}">
                                        {{ $ob->NmObat }} (Stok: {{ $ob->Stok }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control harga-satuan" value="0" readonly>
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1" required oninput="hitungSubtotal(this)">
                        </td>
                        <td>
                            <input type="number" class="form-control subtotal" value="0" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
                
                {{-- BAGIAN 3: TOTAL & PEMBAYARAN (INI YANG BARU) --}}
                <tfoot class="table-group-divider">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">TOTAL TAGIHAN</td>
                        <td>
                            <input type="text" id="grand-total-tampil" class="form-control fw-bold" value="Rp 0" readonly>
                            {{-- Input hidden untuk nilai asli tanpa format Rupiah (biar gampang dihitung JS) --}}
                            <input type="hidden" id="grand-total-asli" value="0">
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-end fw-bold text-primary">BAYAR (TUNAI)</td>
                            <td>
                                {{-- Ubah type="text" dan tambahkan event onkeyup="formatBayar(this)" --}}
                                <input type="text" id="bayar" class="form-control fw-bold text-primary" 
                                    placeholder="Rp 0" onkeyup="formatBayar(this)">
                            </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-end fw-bold text-success">KEMBALI</td>
                        <td>
                            <input type="text" id="kembali" class="form-control fw-bold text-success" value="Rp 0" readonly>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <button type="button" class="btn btn-primary btn-sm mb-3" id="add-row">
                <i class="bi bi-plus-circle"></i> Tambah Item
            </button>

            <div class="d-grid gap-2">
                {{-- Validasi: Tombol submit bisa dibuat disable kalau uang kurang (opsional) --}}
                <button type="submit" class="btn btn-success btn-lg">Simpan Transaksi</button>
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT PERHITUNGAN --}}
<script>
    // 1. Update Harga saat Obat dipilih
    function updateHarga(selectElement) {
        let harga = selectElement.options[selectElement.selectedIndex].getAttribute('data-harga');
        let row = selectElement.closest('tr');
        row.querySelector('.harga-satuan').value = harga;
        hitungSubtotal(selectElement); 
    }

    // 2. Hitung Subtotal per Baris
    function hitungSubtotal(element) {
        let row = element.closest('tr');
        let harga = parseFloat(row.querySelector('.harga-satuan').value) || 0;
        let jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
        let subtotal = harga * jumlah;
        
        row.querySelector('.subtotal').value = subtotal;
        hitungGrandTotal();
    }

    // 3. Hitung Total Tagihan
    function hitungGrandTotal() {
        let allSubtotal = document.querySelectorAll('.subtotal');
        let total = 0;
        
        allSubtotal.forEach(sub => {
            total += parseFloat(sub.value) || 0;
        });

        document.getElementById('grand-total-asli').value = total;
        document.getElementById('grand-total-tampil').value = formatRupiah(total.toString(), 'Rp ');
        
        // Panggil hitung kembalian (biar update kalau total berubah)
        hitungKembalian();
    }

    // 4. Format Input Bayar (Dipanggil saat ngetik)
    function formatBayar(element) {
        // Format tampilan jadi Rupiah
        element.value = formatRupiah(element.value, 'Rp ');
        // Langsung hitung kembalian
        hitungKembalian();
    }

    // 5. Hitung Kembalian (Revisi: Baca format Rupiah)
    function hitungKembalian() {
        let total = parseFloat(document.getElementById('grand-total-asli').value) || 0;
        
        // Ambil nilai bayar, TAPI hapus dulu karakter non-angka (Rp dan Titik)
        let bayarString = document.getElementById('bayar').value.replace(/[^,\d]/g, '');
        let bayar = parseFloat(bayarString) || 0;

        let kembali = bayar - total;

        if(bayar >= total) {
            // Uang cukup
            document.getElementById('kembali').value = formatRupiah(kembali.toString(), 'Rp ');
            document.getElementById('kembali').classList.remove('text-danger');
            document.getElementById('kembali').classList.add('text-success');
        } else {
            // Uang kurang
            let kurang = Math.abs(kembali);
            document.getElementById('kembali').value = "Kurang " + formatRupiah(kurang.toString(), 'Rp ');
            document.getElementById('kembali').classList.remove('text-success');
            document.getElementById('kembali').classList.add('text-danger');
        }
    }

    // 6. Fungsi Helper: Format Rupiah (Sama kayak di Master Obat)
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

    // 7. Tambah Baris Baru
    document.getElementById('add-row').addEventListener('click', function() {
        let table = document.getElementById('keranjang');
        let row = table.rows[0].cloneNode(true);
        
        row.querySelector('select').value = "";
        row.querySelector('.harga-satuan').value = "0";
        row.querySelector('.jumlah').value = "1";
        row.querySelector('.subtotal').value = "0";
        row.querySelector('.remove-row').disabled = false;
        table.appendChild(row);
    });

    // 8. Hapus Baris
    document.getElementById('keranjang').addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            e.target.closest('tr').remove();
            hitungGrandTotal();
        }
    });
</script>
@endsection