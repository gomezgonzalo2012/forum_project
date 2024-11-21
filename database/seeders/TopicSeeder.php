<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    public function run()
    {
        $topics = [
            'Inteligencia Artificial',
            'Machine Learning',
            'Desarrollo Web',
            'Programación Avanzada',
            'Redes y Seguridad',
            'Bases de Datos',
            'Cloud Computing',
            'Computación Cuántica',
            'Big Data',
            'Ciberseguridad',
        ];

        foreach ($topics as $topic) {
            Topic::create([
                'description' => $topic,
                'icon' => 'icono-default.png',
            ]);
        }
    }
}

