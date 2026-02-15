<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pelanggan::create([
            'KdPelanggan' => 'PL001',
            'NmPelanggan' => 'Gilang',
            'Alamat' => 'Jl. Mastrip No. 1',
            'Kota' => 'Jember',
            'NoTelp' => '085157363526'
        ]);

        Pelanggan::create([
            'KdPelanggan' => 'PL002',
            'NmPelanggan' => 'Rizqi',
            'Alamat' => 'Jl. Mastrip No. 2',
            'Kota' => 'Jember',
            'NoTelp' => '085157363782'
        ]);

        Pelanggan::create([
            'KdPelanggan' => 'PL003',
            'NmPelanggan' => 'Umum',
            'Alamat' => '-',
            'Kota' => '-',
            'NoTelp' => '0'
        ]);
    }
}
