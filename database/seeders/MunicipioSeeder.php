<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            ['nombre' => 'Bogota', 'departamento_id' => 1],
            ['nombre' => 'Mosquera', 'departamento_id' => 1],
            ['nombre' => 'Medellin', 'departamento_id' => 2],
            ['nombre' => 'Envigado', 'departamento_id' => 2],
            ['nombre' => 'Tunja', 'departamento_id' => 3],
            ['nombre' => 'Sogamoso', 'departamento_id' => 3],
            ['nombre' => 'Bucaramanga', 'departamento_id' => 4],
            ['nombre' => 'La bricha', 'departamento_id' => 4],
            ['nombre' => 'Ibagué', 'departamento_id' => 5],
            ['nombre' => 'Planadas', 'departamento_id' => 5],
        ];

        foreach ($municipios as $municipio) {
            Municipio::create($municipio);
        }


    }
}
