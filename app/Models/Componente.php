<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'vista'];
    public function bloques()
    {
        return $this->hasMany(Bloque::class);
    }
}
