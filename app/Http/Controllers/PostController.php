<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::orderBy("created_at","desc")
        ->with(["comments","user"])->paginate(10);
        // dd($post);

       // $categories = Category::take(4)->get();

        //$posts = [$post, $categories];
        return view("home", compact('post'));
    }

    public function show($post){ // $post = id
         $postContent= Post::where('id',$post)->with([
            'categories',
            'user',

         ])->first();
         //dd($post->user);
         $comments = Comment::where('post_id', $post)
                        ->whereNull('father_comment_id')
                        ->with('children') // Cargar subcomentarios
                        ->get();

        $postShow= [$postContent, $comments];

         return view("posts.show", compact('postShow'));
        // return view("posts.show");
    }

    public function create(){
        return view("posts.create");
    }

    public function store(Request $request){
        $request->validate([
            'content' =>"required",
            'title' =>'required',
            'category' =>'required|array'
        ]);
         //dd($request);
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id= $request->user_id;
        //$post->post_state = "active";
        // dd($post);

        $post->save();
        $post->categories()->sync($request->category); // asocia la categoria al post
        session()->flash("success"," Discucion creada");

        return redirect()->route('posts.index')->with('success','Discucion creada con éxito.');
    }
}
