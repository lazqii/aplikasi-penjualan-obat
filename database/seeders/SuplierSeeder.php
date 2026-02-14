<?php

namespace Database\Seeders;

use App\Models\Suplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Suplier::create([
            'KdSuplier' => 'SPX001',
            'NmSuplier' => 'Galang',
            'Alamat' => 'Jl. Jawa No. 1',
            'Kota' => 'Jember',
            'NoTelp' => '085157363111'
        ]);

        Suplier::create([
            'KdSuplier' => 'SPX002',
            'NmSuplier' => 'Rizqa',
            'Alamat' => 'Jl. Jawa No. 2',
            'Kota' => 'Jember',
            'NoTelp' => '085157927111'
        ]);
    }
}
