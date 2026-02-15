<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota - {{ $penjualan->Nota }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #eee; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; text-align: right; }
        
        /* Hilangkan elemen lain saat diprint */
        @media print {
            @page { margin: 0.5cm; }
            body { margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>APOTEK SEHAT ABADI</h2>
        <p>Jl. Mastrip No. 123, Jember - Jawa Timur</p>
        <hr>
    </div>

    <table style="border: none;">
        <tr style="border: none;">
            <td style="border: none;">
                <strong>Nota:</strong> {{ $penjualan->Nota }}<br>
                <strong>Tanggal:</strong> {{ date('d-m-Y', strtotime($penjualan->TglNota)) }}
            </td>
            <td style="border: none; text-align: right;">
                <strong>Pelanggan:</strong> {{ $penjualan->pelanggan->NmPelanggan }}<br>
                <strong>Kasir:</strong> Admin
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($penjualan->details as $index => $detail)
            @php 
                $subtotal = $detail->obat->HargaJual * $detail->Jumlah;
                $total += $subtotal;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $detail->obat->NmObat }}</td>
                <td class="text-end">Rp {{ number_format($detail->obat->HargaJual, 0, ',', '.') }}</td>
                <td class="text-center">{{ $detail->Jumlah }}</td>
                <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">TOTAL BAYAR</th>
                <th class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima Kasih</p>
        <br><br>
        <!-- <p>( ....................... )</p> -->
    </div>

</body>
</html>