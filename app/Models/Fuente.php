<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{

    protected $fillable = [
        'invitacion_id',
        'tipo',
        'fuente',
        'cdn'
    ];

}
