<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
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

    public function createWithTopic(Request $request)
    {
        $topic_id = $request->query('topic_id');
        $topic = Topic::find($topic_id);

        // Verificar si el tema existe
        if (!$topic) {
            return redirect()->back()->with('error', 'El tema no existe.');
        }
        // dd($topic->id);
        return view('posts.create', compact('topic'));
    }

    // public function createWithTopic($topic_id){
    //     return view('posts.create', compact('topic_id'));
    // }
    public function store(Request $request){
        $request->validate([
            'content' =>"required",
            'title' =>'required',
            'category' =>'required|array'
        ]);
        if ($request->filled('new_topic')) {

            $topic = Topic::create(['description' => $request->new_topic]);
            $topic->save();
            $topic_id = $topic->id; // se setea el topic id si es que se decide crear el tema
        } else {
            $topic_id = $request->topic_id;// proviene de la request desde la seccion temas
        }
        //  dd($request);
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id= $request->user_id;
        $post->topic_id= $topic_id;
        //$post->post_state = "active";
        // dd($post);

        $post->save();
        $post->categories()->sync($request->category); // asocia la categoria al post
        session()->flash("success"," Discucion creada");

        return redirect()->route('Home.index')->with('success','Discucion creada con éxito.');
    }
}
