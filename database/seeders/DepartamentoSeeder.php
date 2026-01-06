<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            ['nombre' => 'Cundinamarca'],
            ['nombre' => 'Antioquia'],
            ['nombre' => 'Boyaca'],
            ['nombre' => 'Santander'],
            ['nombre' => 'Tolima'],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}
