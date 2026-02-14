<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Obat::create([
            'KdObat' => 'OB001',
            'NmObat' => 'Paracetamol',
            'Jenis' => 'Obat Bebas',
            'Satuan' => 'miligram',
            'HargaBeli' => 10000,
            'HargaJual' => 12000,
            'Stok' => '25',
            'KdSuplier' => 'SPX001'
        ]);
        Obat::create([
            'KdObat' => 'OB002',
            'NmObat' => 'Paracetamol Sirup',
            'Jenis' => 'Obat Bebas',
            'Satuan' => 'mililiter',
            'HargaBeli' => 13000,
            'HargaJual' => 15000,
            'Stok' => '25',
            'KdSuplier' => 'SPX002'
        ]);
    }
}
