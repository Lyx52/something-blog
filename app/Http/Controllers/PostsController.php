<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class PostsController extends Controller
{
    public function createPage() {
        return view("pages.post.create");
    }

    public function updatePage(Post $post) {
        return view("pages.post.update", [
            "post" => $post
        ]);
    }

    public function create(CreatePostRequest $request) {
        $validatedData = $request->validated();
        $body = Purify::config('posts')->clean($validatedData['body']);
        $title = $validatedData['title'];
        $user = Auth::user();

        if (empty($user)) {
            return route('auth.login.page');
        }

        $post = Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user->id,
            'slug' => '',
        ]);

        return redirect()->route('post.view.page', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request) {
        $validatedData = $request->validated();
        $body = Purify::config('posts')->clean($validatedData['body']);
        $title = $validatedData['title'];

        $post = Post::query()->findOrFail($validatedData['id']);
        $post->update([
            'title' => $title,
            'body' => $body,
        ]);

        return redirect()->route('post.view.page', [
            'post' => $post,
        ]);
    }

    public function delete(Post $post) {
        $post->delete();
        return redirect()->route("home.index.page");
    }

    public function view(Post $post) {
        return view("pages.post.view", [
            'post' => $post,
            'author' => $post->author(),
            'comments' => $post->comments()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
