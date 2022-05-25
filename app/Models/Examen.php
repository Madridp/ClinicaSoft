<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'examen';

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
        'id_tipo_examen',
        'fecha',
        'id_paciente',
        'valor_examen',
        'examen_pagado',
        'id_tecnico',
        'id_medico_referente',
        'motivo',
        'adjunto_orden',
        'tiempo_estimado_respuesta',
        'documento_resultado',
        'estado',
        'id_usuario'
    ];
}
