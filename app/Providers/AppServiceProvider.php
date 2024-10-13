<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Category::all());

        $popularPosts = Post::withCount('comments') // Cuenta los comentarios relacionados y agrega la columna comments_count
        ->orderBy('comments_count', 'desc')    // Ordena por la cantidad de comentarios en orden descendente
        ->take(5)                              // Puedes limitar la cantidad de posts más comentados (por ejemplo, 5)
        ->get();                               // Obtener los resultados

        // Comparte los datos con las vistas
        View::share('popularPosts', $popularPosts);
        Paginator::useBootstrapFive(); // le decimos que usamos bootstrap para estilos de paginacion (por defecto tailwind)
    }
}
