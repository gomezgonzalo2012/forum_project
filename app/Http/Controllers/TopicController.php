<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // public function index($id){
    //     $topic = Topic::where('id',$id)->with(['posts'])->first()->paginate(10);;
    //     // dd($topic);
    //     return view("home", compact('topic'));
    // }
    public function index($id)
{
    $topic = Topic::findOrFail($id); // Obtiene el tema
    $posts = $topic->posts()->paginate(10); // Pagina los posts relacionados

    return view("topichome", compact('topic', 'posts'));
}

public function search(Request $request)
{
    $query = $request->input('search');
    $topics = Topic::with('posts')
    ->where('description', 'LIKE', '%' . $query . '%')
    ->paginate(5);
  
    // $topics = Topic::with('posts')->paginate(5);

    return view('home', compact('topics'));
}
}
