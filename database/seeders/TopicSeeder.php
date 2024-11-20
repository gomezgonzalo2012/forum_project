<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    public function run()
    {
        Topic::create(['description' => 'Technology', 'icon' => 'tech-icon.png']);
        Topic::create(['description' => 'Science', 'icon' => 'science-icon.png']);
        Topic::create(['description' => 'Health', 'icon' => 'health-icon.png']);
    }
}
