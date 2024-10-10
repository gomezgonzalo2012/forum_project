<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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
        return redirect()->route('posts.show',$comment->post_id)->with('success','Comentario creado con éxito.');
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
        return redirect()->route('posts.show',$comment->post_id)->with('success','Comentario creado con éxito.');
    }
}
