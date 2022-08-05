<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    public function tipo_insumo()
    {
        return $this->hasOne(TipoInsumo::class,'id', 'id_tipo_insumo');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insumo';

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
        'id_tipo_insumo',
        'codigo',
        'nombre',
        'es_reactivo',
        'estado'
    ];
}
