<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloque_id',
        'hora',
        'actividad',
        'icono'
    ];

    // Relación con bloque
    public function bloque()
    {
        return $this->belongsTo(Bloque::class);
    }
}
