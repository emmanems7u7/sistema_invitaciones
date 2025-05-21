<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ComponentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('componentes')->insert([
            ['id' => 1, 'nombre' => 'carrusel_1', 'tipo' => 'carrusel', 'created_at' => Carbon::parse('2025-03-11 07:32:30'), 'updated_at' => Carbon::parse('2025-03-11 07:32:30')],
            ['id' => 2, 'nombre' => 'info_general_2', 'tipo' => 'info_general', 'created_at' => Carbon::parse('2025-03-11 07:33:58'), 'updated_at' => Carbon::parse('2025-03-11 07:33:58')],
            ['id' => 3, 'nombre' => 'info_general_3', 'tipo' => 'info_general', 'created_at' => Carbon::parse('2025-03-11 07:34:07'), 'updated_at' => Carbon::parse('2025-03-11 07:34:07')],
            ['id' => 4, 'nombre' => 'info_4', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:34:17'), 'updated_at' => Carbon::parse('2025-03-11 07:34:17')],
            ['id' => 5, 'nombre' => 'info_5', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 03:40:01'), 'updated_at' => Carbon::parse('2025-03-11 03:40:01')],
            ['id' => 6, 'nombre' => 'info_6', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:34:38'), 'updated_at' => Carbon::parse('2025-03-11 07:34:38')],
            ['id' => 7, 'nombre' => 'galeria_7', 'tipo' => 'galeria', 'created_at' => Carbon::parse('2025-03-11 07:37:44'), 'updated_at' => Carbon::parse('2025-03-11 07:37:44')],
            ['id' => 8, 'nombre' => 'galeria_8', 'tipo' => 'galeria', 'created_at' => Carbon::parse('2025-03-11 07:37:48'), 'updated_at' => Carbon::parse('2025-03-11 07:37:48')],
            ['id' => 9, 'nombre' => 'galeria_2_9', 'tipo' => 'galeria_2', 'created_at' => Carbon::parse('2025-03-11 07:38:24'), 'updated_at' => Carbon::parse('2025-03-11 07:38:24')],
            ['id' => 10, 'nombre' => 'galeria_2_10', 'tipo' => 'galeria_2', 'created_at' => Carbon::parse('2025-03-11 07:38:28'), 'updated_at' => Carbon::parse('2025-03-11 07:38:28')],
            ['id' => 11, 'nombre' => 'info_11', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:34:58'), 'updated_at' => Carbon::parse('2025-03-11 07:34:58')],
            ['id' => 12, 'nombre' => 'info_12', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:36:07'), 'updated_at' => Carbon::parse('2025-03-11 07:36:07')],
            ['id' => 13, 'nombre' => 'hora_13', 'tipo' => 'hora', 'created_at' => Carbon::parse('2025-03-11 07:36:27'), 'updated_at' => Carbon::parse('2025-03-11 07:36:27')],
            ['id' => 14, 'nombre' => 'info_14', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:36:35'), 'updated_at' => Carbon::parse('2025-03-11 07:36:35')],
            ['id' => 15, 'nombre' => 'info_15', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:36:42'), 'updated_at' => Carbon::parse('2025-03-11 07:36:42')],
            ['id' => 16, 'nombre' => 'carrusel_16', 'tipo' => 'carrusel', 'created_at' => Carbon::parse('2025-03-11 07:36:50'), 'updated_at' => Carbon::parse('2025-03-11 07:36:50')],
            ['id' => 17, 'nombre' => 'info_17', 'tipo' => 'info', 'created_at' => Carbon::parse('2025-03-11 07:36:56'), 'updated_at' => Carbon::parse('2025-03-11 07:36:56')],
        ]);
    }
}
