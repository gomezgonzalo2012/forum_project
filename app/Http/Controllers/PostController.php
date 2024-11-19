<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class PostController extends Controller
{
    public function index(){
        $post = Post::orderBy("created_at","desc")
        ->with(["comments","user"])->paginate(10);
         dd($post);

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


    public function store(Request $request){
        $request->validate([
            'content' =>"required",
            'title' =>'required|max:255',
            'category' =>'required|array'
        ]);
        try {
            if ($request->filled('new_topic')) {
                $topicFound = Topic::where(['description' => $request->new_topic])->first();
                    if($topicFound){
                        return redirect()->back()->with('error', ' El Tema ya existe.');
                    }
                $topic = Topic::create(['description' => $request->new_topic]);
                $topic->save();
                $topic_id = $topic->id; // se setea el topic id si es que se decide crear el tema
           } else {
                $topic_id = $request->topic_id; // proviene de la request desde la seccion temas
           }
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = $request->user_id;
            $post->topic_id = $topic_id;
            $post->save();
            $post->categories()->sync($request->category); // asocia la categoria al post

            session()->flash("success", "Discucion creada");
            return redirect()->back()->with('success', 'Discusión creada con éxito.');
            } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Error al crear la discusión: ' . $e->getMessage());
            }
        }

        public function edit($id){
            $postEdit = Post::where('id',$id)->first();
            $topic = Topic::find($postEdit->topic->id);
            // if($post->created_at > now()->add(60)->min){

            // }
            return view("posts.create", compact('postEdit','topic'));
        }

        public function update(Request $request, $post_id){
            $request->validate([
                'content' =>"required",
                'title' =>'required|max:255',
                'category' =>'required|array'
            ]);
            try {
                $topic_id = $request->topic_id; // proviene de la request desde la seccion temas
                $post = Post::findOrFail($post_id);
                $post->title = $request->title;
                $post->content = $request->content;
                $post->user_id = $request->user_id;
                $post->topic_id = $topic_id;
                $post->save();
                $post->categories()->sync($request->category); // asocia la categoria al post

                return redirect()->back()->with('success', 'Discusión acualizada con éxito.');
                } catch (\Exception $e) {
                 return redirect()->back()->with('error', 'Error al actualizar la discusión: ' . $e->getMessage());
                }
            }

        public function search(Request $request){
            $query = $request->input('search');
            $topicId = $request->input('topic_id');

        // Verifica si existe el tema con el id dado
        $topic = Topic::find($topicId);

        if (!$topic) {
            // Si no se encuentra el tema, puedes redirigir o mostrar un mensaje de error
            return redirect()->back()->withErrors(['Tema no encontrado.']);
        }


        // Filtra los posts por el título y el id del tema
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')
                    ->where('topic_id', $topicId)
                    ->paginate(5);

        return view('topichome', compact('posts', 'topic'));
        }

        public function myPosts()
        {
            if (!Auth::check()) {
                return redirect()->back()->with('error', 'Debes iniciar sesión para ver tus posts.');
            }
            $myPosts = Post::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->with(['comments', 'user'])
                ->paginate(10);
            // dd($myPosts);
            return view('posts.my-posts', compact('myPosts'));
        }

}
