<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    //
    protected $table = 'penjualan_details';
    public $incrementing = false;
    protected $fillable = ['Nota', 'KdObat', 'Jumlah'];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'KdObat', 'KdObat');
    }
}
