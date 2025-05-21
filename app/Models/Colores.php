<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitacion_id',
        'codigo',
        'tipo'
    ];

    // Relación con Invitacion
    public function invitacion()
    {
        return $this->belongsTo(Invitacion::class);
    }
}
