<?php

namespace Database\Seeders;

use App\Models\Pembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pembelian::create([
            'Nota' => 'PB001',
            'TglNota' => now(),
            'KdSuplier' => 'SPX001',
            'Diskon' => 0
        ]);
    }
}
