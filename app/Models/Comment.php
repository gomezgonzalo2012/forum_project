<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ["content", "likes", "dislikes","comment_state", "user_id","post_id","father_comment_id","comment_level"];
    protected $table ="comments";

// relaciones inversas
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function children(){ // para acceder a los comentarios hijos
        return $this->hasMany(Comment::class, 'father_comment_id');
    }

    public function parent(){ // para acceder al comentario padre
        return $this->belongsTo(Comment::class, 'father_comment_id');
    }

    public function reactions(){
        return $this->hasMany(CommentUserReaction::class);
    }
    public function userReaction($userId){
        return $this->reactions()->where('user_id',$userId)->first();
    }
}
