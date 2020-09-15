<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tareas extends Model
{
    //

    protected $fillable = [
        'descripcion',
        'tipo_duracion',
        'asignar_hora',
        'fecha',
        'tiempo_termino',
        'status'
    ];


    protected $casts = [
        'fecha' => 'datetime:Y-m-d',
        'asignar_hora' => 'datetime:H:i:s',
        'tiempo_termino' => 'datetime:H:i:s'
    ];
}
