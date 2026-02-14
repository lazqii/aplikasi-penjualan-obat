<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Penjualan::create([
            'Nota' => 'PJ001',
            'TglNota' => now(),
            'KdPelanggan' => 'PL001',
            'Diskon' => 0
        ]);
    }
}
