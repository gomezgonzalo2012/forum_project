<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('user_rol', 'user')->first();
        $posts = Post::all();

        for ($i = 1; $i <= 20; $i++) {
            $post = $posts[$i % $posts->count()];
            $comment = Comment::create([
                'content' => "Este es un comentario sobre el post: {$post->title}",
                'user_id' => $user->id,
                'post_id' => $post->id,
                'likes' => rand(0, 50),
                'dislikes' => rand(0, 30),
                'comment_state' => $i % 2 == 0 ? 'activo' : 'desactivo',
                'comment_level' => 1,
            ]);

            if ($i % 3 == 0) { // Cada 3 comentarios, agregar un hijo
                Comment::create([
                    'content' => "Respuesta al comentario {$comment->id}",
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'father_comment_id' => $comment->id,
                    'likes' => rand(0, 20),
                    'dislikes' => rand(0, 15),
                    'comment_state' => 'activo',
                    'comment_level' => 2,
                ]);
            }
        }
    }
}

