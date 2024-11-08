<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request ){
        //dd($request->post_id);
        //dd($request->user_id);

        $request->validate([
            'content' =>'required',
            'user_id'=>'required',
            'post_id'=>'required'
        ]);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;

        $comment->save();
        return redirect()->back();
    }

    public function storeChild(Request $request ){
        //dd($request->post_id);
        //dd($request->user_id);
        $request->validate([
            'content' =>'required',
            'user_id'=>'required',
            'post_id'=>'required',
            'father_comment_id'=>'required',

        ]);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->father_comment_id= $request->father_comment_id;
        $comment->save();
        $this->createNotification($comment); // crear notificaciion
        return redirect()->back(); // agregar mensaje
    }

    // likes y dislikes
    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->increment('likes'); // Incrementa el contador de likes en 1
        return response()->json(['likes' => $comment->likes, 'dislikes' => $comment->dislikes]);
    }

    public function dislike($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->increment('dislikes'); // Incrementa el contador de dislikes en 1
        return response()->json(['likes' => $comment->likes, 'dislikes' => $comment->dislikes]);
    }

    // crear notificaciones
    public function createNotification(Comment $comment){
        // dd(Auth::id());
        $postId = $comment->post_id;

        //  usuarios suscritos que hayan comentado en el mismo post
        $usuariosSuscritos = User::whereHas('comments', function ($query) use ($postId) {
            $query->where('post_id', $postId);
        })->where('id', '!=', Auth::id())->get();
        // dd($usuariosSuscritos);

        // envia la notif a cada usuario suscrito
        foreach ($usuariosSuscritos as $user) {
            $user->notify(new NewCommentNotification($comment));
        }
    }
}
