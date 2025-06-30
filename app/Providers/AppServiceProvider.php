<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // User's authorization policy for posts
        Gate::policy(Post::class, PostPolicy::class);

        // User's authorization policy for comments
        Gate::policy(Comment::class, CommentPolicy::class);
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
