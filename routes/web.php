<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// impide ver formulario y metodo de creacion si no hay usuario aut.
Route::middleware('auth')->group(function(){
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    //Route::get('/posts/edit', [PostController::class, 'edit'])->name('posts.edit');
});

Route::get('/home',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::middleware('auth')->group(function(){
    Route::post('/comments', [CommentController::class, "store"])->name("comments.store");
    Route::post('/comments/child', [CommentController::class, "storeChild"])->name("comments.storeChild");

});

Route::get("/posteos/{post}", function($post){
    $userName = Post::findOrFail($post)->user->name;

    return $userName;
});

// Route::get('/categoria', function () {
//     $category = new Category();
//     $category->name = 'FrontEnd';
//     $category->save();
//     return $category;
// });
// Route::get('/categoria', function () {
//     $post= Post::find(10);
//     $category = Category::find(2);
//     $post->categories()->attach($category->id);
//     return $post;
// });
Route::get('/categoria', function () {
        $post= Post::where('id',10)->with('categories')->first();

        return $post;
    });

require __DIR__.'/auth.php';
