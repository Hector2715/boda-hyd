<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    protected $table = 'invitados';

    protected $fillable = [
        'nombre_familia',
        'token',
        'cupos_max',
        'cupos_confirmados',
        'asistira',
        'mensaje_novios',
        'confirmado_el',
    ];
}
