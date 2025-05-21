<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acompanante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'invitacion_id'
    ];

    // Relación con Invitacion
    public function invitacion()
    {
        return $this->belongsTo(Invitacion::class);
    }
}
