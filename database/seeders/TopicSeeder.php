<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['description' => 'Introducción al foro', 'icon' => '📢'],
            ['description' => 'Reglas de la comunidad', 'icon' => '📜'],
            ['description' => 'Noticias y actualizaciones', 'icon' => '📰'],
            ['description' => 'Sugerencias de los usuarios', 'icon' => '💡'],
            ['description' => 'Problemas y errores técnicos', 'icon' => '⚙️'],
            ['description' => 'Proyectos colaborativos', 'icon' => '🤝'],
            ['description' => 'Eventos en vivo', 'icon' => '🎥'],
            ['description' => 'Desarrollo web', 'icon' => '💻'],
            ['description' => 'Recursos educativos', 'icon' => '📚'],
            ['description' => 'Arte y diseño', 'icon' => '🎨'],
            ['description' => 'Cultura y entretenimiento', 'icon' => '🎭'],
            ['description' => 'Deportes y bienestar', 'icon' => '⚽'],
            ['description' => 'Viajes y turismo', 'icon' => '✈️'],
            ['description' => 'Tecnología emergente', 'icon' => '🤖'],
            ['description' => 'Ciencia y exploración', 'icon' => '🔭'],
        ];
        DB::table('topics')->insert($data);
    }
}
