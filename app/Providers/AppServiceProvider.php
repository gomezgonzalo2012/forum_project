<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('categories') && Schema::hasTable('posts')) {
            View::share('categories', Category::all());

            $popularPosts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(10)
                ->get();

            View::share('popularPosts', $popularPosts);
        }

        Paginator::useBootstrapFive();
    }
}
