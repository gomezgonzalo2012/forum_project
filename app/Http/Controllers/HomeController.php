<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $topics = Topic::with('posts')->paginate(10);

        return view("home", compact('topics'));
    }


}
