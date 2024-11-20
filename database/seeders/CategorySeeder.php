<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Programming']);
        Category::create(['name' => 'Physics']);
        Category::create(['name' => 'Medicine']);
    }
}
