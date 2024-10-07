<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::orderBy("created_at","desc")
        ->with(["comments"])->get();
        $categories = Category::take(4)->get();

        $posts = [$post, $categories];
        return view("home", compact('posts'));
    }

    public function show($post){
         $post= Post::where('id',$post)->with([
            'categories',
            'users',
            'comments.children',

         ])->first();
         return view("posts.show", compact('post'));
        // return view("posts.show");
    }

    public function create(){
        return view("posts.create");
    }

    public function store(Request $request){
        $request->validate([
            'content' =>"required",
            'title' =>'required'
        ]);
        // dd($request);
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        //$post->post_state = "active";
        $post->save();
        return redirect()->route('posts.index')->with('success','Discucion creada con éxito.');
    }
}
