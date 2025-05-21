<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nombre',
        'fecha',
        'hora_inicio',
        'user_id',
        'direccion',
        'geolocalizacion'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relación con Colores
    public function colores()
    {
        return $this->hasMany(Colores::class);
    }
    // Relación con Invitados
    public function invitados()
    {
        return $this->hasMany(Invitado::class);
    }
    public function bloques()
    {
        return $this->hasMany(Bloque::class);
    }
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class);
    }
}
