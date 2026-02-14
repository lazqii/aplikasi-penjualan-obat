<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    //
    protected $table = 'pembelian_details';
    public $incrementing = false;
    protected $fillable = ['Nota', 'KdObat', 'Jumlah'];
    

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'KdObat', 'KdObat');
    }
}
