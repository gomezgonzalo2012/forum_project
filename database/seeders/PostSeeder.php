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
        $topic = Topic::first();

        $post1 = Post::create([
            'title' => 'The Future of AI',
            'content' => 'AI is transforming industries...',
            'user_id' => $user->id,
            'topic_id' => $topic->id,
            'post_state' => 'published',
        ]);

        $post2 = Post::create([
            'title' => 'Quantum Computing',
            'content' => 'Quantum computers will change the world...',
            'user_id' => $user->id,
            'topic_id' => $topic->id,
            'post_state' => 'draft',
        ]);

        // Asocia categorías
        $post1->categories()->attach([1, 2]);
        $post2->categories()->attach([2, 3]);
    }
}
