<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    //
    protected $table = 'supliers';
    protected $primaryKey = 'KdSuplier';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['KdSuplier', 'NmSuplier', 'Alamat', 'Kota', 'NoTelp'];

    public function obats()
    {
        return $this->hasMany(Obat::class, 'KdSuplier', 'KdSuplier');
    }
}
