<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeudaProveedor extends Model
{
    use HasFactory;

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class,'id', 'id_proveedor');
    }

    public function compra()
    {
        return $this->hasOne(Compra::class,'id', 'id_compra');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deuda_proveedor';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_proveedor',
        'id_compra',
        'debe',
        'haber',
        'saldo',
        'descripcion',
        'estado'
    ];
}
