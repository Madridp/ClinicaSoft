<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTipoExamen extends Model
{
    use HasFactory;

    public function tipo_examen()
    {
        return $this->hasOne(TipoExamen::class,'id', 'id_tipo_examen');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detalle_tipo_examen';

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
        'id',
        'id_examen',
        'id_tipo_examen',
        'valor_examen',
        'descuento',
        'total_examen',
        'estado'
    ];
}
