<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero'; // Cabe aclarar que se hacen las tablas con el nombre que se dio en los requerimientos de la prueba

    protected $fillable = [
        'nombre',
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
