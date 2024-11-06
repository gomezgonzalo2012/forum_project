<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

//     public function index(){ // $post = id
//         $posts = Post::orderBy("created_at","desc")
//         ->with(["comments","user"])->paginate(10);
//         //  dd($post);

//         return view("admin.showAdmin", compact('posts'));
//    }
    public function index(){ // $post = id
        $posts = Post::with(['comments', 'user'])
            ->withCount([
                'comments as total_dislikes' => function ($query) {
                    $query->select(DB::raw("SUM(dislikes)"));
                }
            ])
            ->orderBy('total_dislikes', 'desc') // Ordena por el total de dislikes en los comentarios de cada post
            ->orderBy('created_at', 'desc') // Luego, por la fecha de creación si hay empates en dislikes
            ->paginate(10);
            // dd($posts);
        return view("admin.indexAdmin", compact('posts'));
    }

    public function show($post){ // $post = id
        $postContent= Post::where('id',$post)->with([
           'categories',
           'user',

        ])->first();
        //dd($post->user);
        $comments = Comment::where('post_id', $post)
                       ->whereNull('father_comment_id')
                       ->with('children')
                       ->get();

       $postShow= [$postContent, $comments];

        return view("admin.showAdmin", compact('postShow'));
       // return view("posts.show");
   }



    public function updateStatus(Request $request)
    {

        // Obtén la lista de IDs de comentarios a desactivar
        $commentsToDeactivate = $request->input('comments_to_deactivate', []);
        $commentsToActivate = $request->input('comments_to_activate', []);

        // dd($commentsToDeactivate);

        // Actualiza los comentarios seleccionados a 'desactivo'
        Comment::whereIn('id', $commentsToDeactivate)->update(['comment_state' => 'desactivo']);

        // Opcional: Activar los comentarios seleccionados a 'activo'
        Comment::whereIn('id', $commentsToActivate)->update(['comment_state' => 'activo']);

        return redirect()->back()->with('status', 'Comentarios actualizados exitosamente.');
    }


   public function enablePost(){

   }
   public function disableComment(){

   }

   public function enableComment(){

   }

   public function createCategory(){

   }

}
