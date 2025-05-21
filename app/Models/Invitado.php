<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'asistencia',
        'invitacion_id',
        'email',
        'celular',
    ];

    // Relación con Invitacion
    public function invitacion()
    {
        return $this->belongsTo(Bloque::class);
    }

}
