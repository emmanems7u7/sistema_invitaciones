<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia_mensaje extends Model
{
    use HasFactory;
    protected $table = 'multimedia_mensajes';
    protected $fillable = ['nombre', 'ruta', 'mensaje_id'];

    public function mensaje()
    {
        return $this->belongsTo(Mensaje::class, 'mensaje_id');
    }

}
