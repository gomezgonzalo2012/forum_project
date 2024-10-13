<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
         $post= Post::where('id',$post)->with([
            'categories',
            'user',
            'comments.children',

         ])->first();
         //dd($post->user);
         $renderedComments[] = [];
         return view("posts.show", compact('post',"renderedComments"));
        // return view("posts.show");
    }

    public function create(){
        return view("posts.create");
    }

    public function store(Request $request){
        //dd($request->content);
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
        $post->save();
        $post->categories()->sync($request->category); // asocia la categoria al post
        session()->flash("success"," Discucion creada");

        return redirect()->route('posts.index')->with('success','Discucion creada con éxito.');
    }
}
