<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TopicSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CommentUserReactionSeeder::class,
        ]);
    }
}

