<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy("created_at","desc")->get();

        return view("home", compact('posts'));
    }

    public function show($post){
         $post= Post::findorFail($post);
         return view("posts.show", compact('post'));
        // return view("posts.show");
    }
}
