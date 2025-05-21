<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'nombre', 'html', 'css_path', 'js_path'];

    public function bloques()
    {
        return $this->hasMany(Bloque::class);
    }
}
