<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //
    protected $table = 'pembelians';
    protected $primaryKey = 'Nota';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Nota', 'TglNota', 'KdSuplier', 'Diskon'];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'KdSuplier', 'KdSuplier');
    }
}
