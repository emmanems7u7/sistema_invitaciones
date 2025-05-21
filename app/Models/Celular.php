<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;

    protected $fillable = [
        'celular',
        'whatsapp',
        'tipo_id',
        'tipo_type'
    ];

    // Relación polimórfica (puede estar relacionado con diferentes modelos)
    public function tipo()
    {
        return $this->morphTo();
    }
}
