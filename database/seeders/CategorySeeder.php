<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =[
            ['name' => 'Introducción'],
            ['name' => 'Reglas'],
            ['name' => 'Actualizaciones'],
            ['name' => 'Sugerencias'],
            ['name' => 'Soporte Técnico'],
            ['name' => 'Colaboración'],
            ['name' => 'Eventos'],
            ['name' => 'Desarrollo Frontend'],
            ['name' => 'Desarrollo Backend'],
            ['name' => 'Recursos Educativos'],
            ['name' => 'Diseño Gráfico'],
            ['name' => 'Entretenimiento'],
            ['name' => 'Deportes'],
            ['name' => 'Tecnología'],
            ['name' => 'Ciencia y Exploración'],
        ];
        DB::table('categories')->insert($categories);
    }
}
