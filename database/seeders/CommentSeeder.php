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
        $post = Post::first();
        $user = User::where('user_rol', 'user')->first();

        $comment1 = Comment::create([
            'content' => 'This is a great post!',
            'user_id' => $user->id,
            'post_id' => $post->id,
            'likes' => 10,
            'dislikes' => 2,
            'comment_state' => 'activo',
            'comment_level'=>1
        ]);

        $comment2 = Comment::create([
            'content' => 'I disagree with this post.',
            'user_id' => $user->id,
            'post_id' => $post->id,
            'father_comment_id' => $comment1->id,
            'likes' => 2,
            'dislikes' => 15,
            'comment_state' => 'activo',
            'comment_level'=>2

        ]);
    }
}
