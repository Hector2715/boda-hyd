<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    protected $table = 'invitados';

    protected $fillable = [
        'nombre_familia',
        'cupos_confirmados', // Cuántos asisten
        'nombres_asistentes', // Nombre de los que asisten
        'asistira',
        'confirmado_el',
        'mensaje_novios',
    ];
}
