<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    //
    protected $table = 'obats';
    protected $primaryKey = 'KdObat';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['KdObat', 'NmObat', 'Jenis', 'Satuan', 'HargaBeli', 'HargaJual', 'Stok', 'KdSuplier'];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'KdSuplier', 'KdSuplier');
    }

    public function getHargaBeliRupiahAttribute()
    {
        return "Rp " . number_format($this->HargaBeli, 0, ',', '.');
    }

    public function getHargaJualRupiahAttribute()
    {
        return "Rp " . number_format($this->HargaJual, 0, ',', '.');
    }
}
