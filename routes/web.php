<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostsController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/**
 * AUTHORIZATION/AUTHENTICATION
 */
Route::name("auth.")->group(function () {
    Route::get("/login", [AuthController::class, "loginPage"])->name("login.page");
    Route::post("/login", [AuthController::class, "login"])->name("login");

    Route::get("/register", [AuthController::class, "registerPage"])->name("register.page");
    Route::post("/register", [AuthController::class, "register"])->name("register");

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

/**
 * HOME/USER
 */

Route::name("home.")->group(function () {
    Route::get("/", [HomepageController::class, "index"])->name("index.page");
    Route::get("/load-more", [HomepageController::class, "loadMore"])->name("load-more");
});

// Authorized
Route::name("home.")->middleware("auth")->group(function () {
    Route::get("/my-posts", [HomepageController::class, "userPosts"])->name("my-posts.page");
});

/**
 * POSTS
 */
Route::get("/post/{post}", [PostsController::class, "view"])->name("post.view.page");

// Authorized
Route::middleware("auth")->name("post.")->group(function () {
    Route::get("/post/create/new", [PostsController::class, "createPage"])->name("create.page");

    // Create post
    Route::post("/post/create/new", [PostsController::class, "create"])
        ->name("create")
        ->can('create', [Post::class]);

    // Update post
    Route::get("/post/update/{post}", [PostsController::class, "updatePage"])
        ->name("update.page")
        ->can('update', 'post');

    Route::post("/post/update", [PostsController::class, "update"])
        ->name("update");

    // Delete post
    Route::delete("/post/delete/{post:id}", [PostsController::class, "delete"])
        ->name("delete")
        ->can('delete', 'post');
});

/**
 * COMMENTS
 */

// Authorized
Route::middleware("auth")->name("comment.")->group(function () {
    Route::post("/comment/create", [CommentController::class, "create"])
        ->name("create");

    Route::delete("/comment/delete/{comment}", [CommentController::class, "delete"])
        ->name("delete");
});
