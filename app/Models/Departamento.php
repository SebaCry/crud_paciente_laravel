<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos'; // Cabe aclarar que se hacen las tablas con el nombre que se dio en los requerimientos de la prueba

    protected $fillable = [
        'nombre',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
