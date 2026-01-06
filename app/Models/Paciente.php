<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente'; // Cabe aclarar que se hacen las tablas con el nombre que se dio en los requerimientos de la prueba

    protected $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'genero_id',
        'departamento_id',
        'municipio_id',
        'foto',
    ];

    // Las relaciones de la base de datos referentes a esta tabla Pacientes

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
