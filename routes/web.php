<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TopicController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/',[HomeController::class,'index'])->name('Home.index');

Route::get('/posts',[PostController::class,'index'])->name('posts.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/notifications',[ProfileController::class, 'notifications'])->name('profile.notifications');

});

// impide ver formulario y metodo de creacion si no hay usuario aut.
Route::middleware('auth')->group(function(){
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::get('/posts/createWithTopic',[PostController::class,'createWithTopic'])->name('posts.createWithTopic');
    //edit
    Route::get('/posts/edit/{post_id}',[PostController::class, 'edit'])->name("posts.edit");
    Route::put('/posts/update/{post_id}',[PostController::class, 'update'])->name("posts.update");
    // "mis posts"
    Route::get('/posts/misPosts',[PostController::class, 'myPosts'])->name("posts.myPosts");

});


// Route::get('/home',[PostController::class,'index'])->name('posts.index'); ya no se usa
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

// topics
Route::get('/topics/{id}',[TopicController::class,'index'])->name('topics.index');

// Rutas para búsqueda
Route::get('/search/topics', [TopicController::class, 'search'])->name('topics.search');
Route::get('/search/posts', [PostController::class, 'search'])->name('posts.search');

Route::middleware('auth')->group(function(){
    Route::post('/comments', [CommentController::class, "store"])->name("comments.store");
    Route::post('/comments/child', [CommentController::class, "storeChild"])->name("comments.storeChild");
    Route::post('/comments/{commentId}/like', [CommentController::class, "like"])->name("comments.like");
    Route::post('/comments/{commentId}/dislike', [CommentController::class, "dislike"])->name("comments.dislike");
    Route::post('/comments/{commentId}/reactToComment', [CommentController::class, "reactToComment"])->name("comments.reactToComment");
    //edit

    Route::put('/comments/update/{commentId}', [CommentController::class, "update"])->name("comments.update");



});

Route::middleware('auth','role:admin,superAdmin')->group(function(){ //'role:admin'
    Route::post('/admin/updateStatus', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    // categorias
    Route::get('/admin/createCategory',[AdminController::class,'createCategory'])->name('admin.createCategory');
    Route::post('/admin/storeCategory',[AdminController::class,'storeCategory'])->name('admin.storeCategory');
    Route::get('/admin/editCategory/{category_id}',[AdminController::class,'editCategory'])->name('admin.editCategory');
    Route::put('/admin/updateCategory/{category_id}',[AdminController::class,'updateCategory'])->name('admin.updateCategory');

    Route::get('/admin/posts',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/{post}',[AdminController::class,'show'])->name('admin.show');
    // super admin
    Route::get("/superAdmin",[SuperAdminController::class, 'index'])->name('superAdmin.index');
    Route::put("/superAdmin/{user_id}",[SuperAdminController::class, 'updateRole'])->name('superAdmin.updateRole');
});

Route::get('/category/{category_id}', [CategoryController::class, "categoryWithPosts"])->name('category.withPosts');

require __DIR__.'/auth.php';
