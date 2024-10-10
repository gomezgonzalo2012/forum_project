<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ["content", "votes", "comment_state", "user_id","post_id","father_comment_id"];
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

}
