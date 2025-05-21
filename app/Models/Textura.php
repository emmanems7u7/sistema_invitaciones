<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Textura extends Model
{

    protected $fillable = [
        'textura'
    ];

    public function bloques()
    {
        return $this->hasMany(Bloque::class, 'textura_id');
    }
}
