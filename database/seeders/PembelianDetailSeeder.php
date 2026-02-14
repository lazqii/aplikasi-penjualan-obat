<?php

namespace Database\Seeders;

use App\Models\PembelianDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PembelianDetail::create([
            'Nota' => 'PB001',
            'KdObat' => 'OB001',
            'Jumlah' => 20
        ]);
    }
}
