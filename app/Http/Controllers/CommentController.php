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
        try { $comment = new Comment(); $comment->content = $request->content; $comment->user_id = $request->user_id; $comment->post_id = $request->post_id; $comment->save(); return redirect()->back()->with('success', 'Comment successfully added!'); } catch (\Exception $e) { return redirect()->back()->with('error', 'Failed to add comment: ' . $e->getMessage()); } 
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
        try { $comment = new Comment(); $comment->content = $request->content; $comment->user_id = $request->user_id; $comment->post_id = $request->post_id; $comment->father_comment_id = $request->father_comment_id; $comment->save(); 
            return redirect()->back()->with('success', 'Reply successfully added!'); 
        } catch (\Exception $e) 
        { 
            return redirect()->back()->with('error', 'Failed to add reply: ' . $e->getMessage()); 
        }

    }

    // likes y dislikes

    // En el controlador CommentController
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

}
