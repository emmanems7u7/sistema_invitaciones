<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['invitacion_id', 'nombre', 'mensaje'];

    // Relación con la invitación
    public function invitacion()
    {
        return $this->belongsTo(Invitacion::class);
    }
    public function multimedia()
    {
        return $this->hasMany(Multimedia_mensaje::class, 'mensaje_id');
    }
}
