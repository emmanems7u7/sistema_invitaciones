<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloque_id',
        'tipo',
        'ruta',
        'galeria'
    ];

    // Relación con Invitacion
    public function Bloque()
    {
        return $this->belongsTo(Bloque::class);
    }
}
