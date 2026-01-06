<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposDocumento = [
            ['nombre' => 'Cédula de ciudadanía'],
            ['nombre' => 'Tarjeta de identidad'],
        ];

        foreach ($tiposDocumento as $tipoDocumento) {
            TipoDocumento::create($tipoDocumento);
        }
    }
}
