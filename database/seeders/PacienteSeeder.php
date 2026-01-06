<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1107978318',
                'nombre1' => 'Juan',
                'nombre2' => 'Sebastian',
                'apellido1' => 'Pérez',
                'apellido2' => 'Cedano',
                'genero_id' => 1,
                'departamento_id' => 5,
                'municipio_id' => 9,
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '1011326355',
                'nombre1' => 'Danna',
                'nombre2' => 'Valentina',
                'apellido1' => 'Pérez',
                'apellido2' => 'Cedano',
                'genero_id' => 2,
                'departamento_id' => 1,
                'municipio_id' => 2,
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '2001234567',
                'nombre1' => 'Pedro',
                'nombre2' => null,
                'apellido1' => 'Martínez',
                'apellido2' => 'Sánchez',
                'genero_id' => 1,
                'departamento_id' => 3,
                'municipio_id' => 5,
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '1003456789',
                'nombre1' => 'Ana',
                'nombre2' => 'Lucía',
                'apellido1' => 'González',
                'apellido2' => null,
                'genero_id' => 2,
                'departamento_id' => 4,
                'municipio_id' => 7,
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '2002345678',
                'nombre1' => 'Luis',
                'nombre2' => 'Fernando',
                'apellido1' => 'Hernández',
                'apellido2' => 'Torres',
                'genero_id' => 1,
                'departamento_id' => 5,
                'municipio_id' => 9,
            ],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}
