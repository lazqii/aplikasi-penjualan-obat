<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $table = 'penjualans';
    protected $primaryKey = 'Nota';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Nota', 'TglNota', 'KdPelanggan', 'Diskon'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'KdPelanggan', 'KdPelanggan');
    }

    public function details()
    {
        return $this->hasMany(PenjualanDetail::class, 'Nota', 'Nota');
    }
}
