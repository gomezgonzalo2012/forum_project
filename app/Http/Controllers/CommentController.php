<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentUserReaction;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PharIo\Manifest\AuthorCollection;

class CommentController extends Controller
{
    public function store(Request $request ){
        //dd($request->post_id);
        //dd($request->user_id);

        $request->validate([
            'content' =>'required|max:255',
            'user_id'=>'required',
            'post_id'=>'required'
        ]);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment_level =1;
        $comment->save();
        return redirect()->back()->with('success', 'Comentario añadido con éxito.');
    }

    public function storeChild(Request $request ){
        //dd($request->post_id);
        //dd($request->user_id);
        $request->validate([
            'content' =>'required|max:255',
            'user_id'=>'required',
            'post_id'=>'required',
            'father_comment_id'=>'required',

        ]);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->father_comment_id= $request->father_comment_id;
        // valido nivel de comentario padre
        $fatherComment  = Comment::where('id',$request->father_comment_id)->first();

        switch($fatherComment->comment_level){
            case 1: $comment->comment_level = 2;
            break;
            case 2: $comment->comment_level = 3;
            break;
            case 3: $comment->comment_level = 4;
            break;
            default:
            return redirect()->back();
        }
        // dd($comment);
        $comment->save();
        $this->createNotification($comment); // crear notificaciion
        return redirect()->back(); // agregar mensaje
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::findOrFail($id);

        // solo el usuario dueño del commentario puede editarlo
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comentario actualizado con éxito.');
    }


    // likes y dislikes

    public function reactToComment(Request $request, $comment_id){
        $actualUser = Auth::user()->id;
        $reaction = $request->reaction;

        $sameUser = Comment::where('id', $comment_id)->where('user_id', $actualUser)->exists();
        // dd($sameUser);
        if ($sameUser) {
            return response()->json(['error' => 'No puedes reaccionar a tu comentario'], 403);
        }

        $alredyReacted = CommentUserReaction::where('user_id',$actualUser)->where('comment_id',$comment_id)->first();
        if ($alredyReacted) {
            return response()->json(['error' => 'Ya reaccionaste a este comentario'], 403);
        }


        CommentUserReaction::create([
            'user_id'=>$actualUser,
            'comment_id'=>$comment_id,
            'reaction'=>$reaction // puede ser likes o dislikes
        ]);

        // Actualizar contador en el comentario
        $comment = Comment::find($comment_id);
        if ($reaction === 'likes') {
            $comment->increment('likes');
        } else {
            $comment->increment('dislikes');
        }
        // Devolver ambos contadores
        return response()->json([
            'likes' => $comment->likes,
            'dislikes' => $comment->dislikes
        ]);

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
