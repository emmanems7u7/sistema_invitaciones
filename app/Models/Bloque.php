<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Bloque extends Model
{
    use HasFactory;
    protected $fillable = ['tipo', 'posicion', 'invitacion_id', 'componente_id', 'textura_id'];
    // Relación con Textos
    public function textos()
    {
        return $this->hasMany(Texto::class);
    }

    // Relación con Cronogramas
    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }

    // Relación con Multimedias
    public function multimedias()
    {
        return $this->hasMany(Multimedia::class);
    }


    public function invitacion()
    {
        return $this->belongsTo(Invitacion::class);
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'componente_id');
    }

    public function textura()
    {
        return $this->belongsTo(Textura::class, 'textura_id');
    }

}
