<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ContenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['identificador' => 'carrusel', 'contenido' => 'Carrusel'],
            ['identificador' => 'info_general', 'contenido' => 'Información General'],
            ['identificador' => 'info', 'contenido' => 'Información'],
            ['identificador' => 'galeria', 'contenido' => 'Galería'],
            ['identificador' => 'galeria_2', 'contenido' => 'Galería 2'],
            ['identificador' => 'hora', 'contenido' => 'Contador'],
            ['identificador' => 'ubicacion', 'contenido' => 'Ubicación'],
        ];

        foreach ($tipos as $tipo) {
            DB::table('contenidos')->insert($tipo);
        }
    }
}
