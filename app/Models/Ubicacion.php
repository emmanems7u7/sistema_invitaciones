<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $fillable = [
        'invitacion_id',
        'actividad',
        'fecha',
        'hora_inicio',
        'direccion',
        'geolocalizacion',
        'icono',
        'imagen'
    ];
    public function invitacion()
    {
        return $this->belongsTo(Invitacion::class);
    }
}
