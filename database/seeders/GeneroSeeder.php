<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            ['nombre' => 'Masculino'],
            ['nombre' => 'Femenino'],
            ['nombre' => 'Otro'],
        ];

        foreach ($generos as $genero) {
            Genero::create($genero);
        }
    }
}
