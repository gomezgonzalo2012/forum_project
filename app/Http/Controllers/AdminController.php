<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function show(){ // $post = id


        return view("admin.showAdmin");
       // return view("posts.show");
   }
}
