<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
     protected $table = 'pelanggans';
    protected $primaryKey = 'KdPelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['KdPelanggan', 'NmPelanggan', 'Alamat', 'Kota', 'NoTelp'];

    public function obats()
    {
        return $this->hasMany(Obat::class, 'KdPelanggan', 'KdPelanggan');
    }
}
