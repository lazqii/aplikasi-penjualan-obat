<?php

namespace Database\Seeders;

use App\Models\PenjualanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PenjualanDetail::create([
            'Nota' => 'PJ001',
            'KdObat' => 'OB001',
            'Jumlah' => 2
        ]);
    }
}
