<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommentUserReaction;
use App\Models\Comment;
use App\Models\User;

class CommentUserReactionSeeder extends Seeder
{
    public function run()
    {
        $comment = Comment::first();
        $user = User::where('user_rol', 'moderator')->first();

        CommentUserReaction::create([
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);
    }
}
