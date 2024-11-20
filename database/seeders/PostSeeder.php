<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;


class PostSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('user_rol', 'admin')->first();
        $topics = Topic::all();

        $posts = [
            'El impacto de la IA en la industria del software',
            'Frameworks de JavaScript más populares',
            'Buenas prácticas en desarrollo web',
            'Cómo optimizar bases de datos SQL',
            'Ciberseguridad en la nube',
            'Introducción a la programación cuántica',
            'Los lenguajes de programación más usados en 2024',
            'Comparativa entre servidores web',
            'Avances en aprendizaje automático',
            'Tendencias en Big Data para empresas',
        ];

        foreach ($posts as $index => $postTitle) {
            $post = Post::create([
                'title' => $postTitle,
                'content' => 'Este es el contenido del post relacionado con ' . $postTitle,
                'user_id' => $user->id,
                'topic_id' => $topics[$index % $topics->count()]->id,
                'post_state' => $index % 2 == 0 ? 'activo' : 'desactivo',
            ]);

            $post->categories()->attach([$index % 10 + 1, ($index + 1) % 10 + 1]);
        }
    }
}

