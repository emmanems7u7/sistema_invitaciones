<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'contenido',
        'bloque_id'
    ];

    // Relación con Bloque
    public function Bloque()
    {
        return $this->belongsTo(Bloque::class);
    }
}
