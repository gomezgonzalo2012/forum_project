<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryWithPosts($category_id) {
        $category = Category::findOrFail($category_id);
        $posts = $category->posts()->paginate(5);

        return view("posts.posts_category", compact('category', 'posts'));
    }

}
