<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class PostsController extends Controller
{
    public function createPage() {
        $categories = Category::all();
        return view("pages.post.create", [
            'categories' => $categories,
        ]);
    }

    public function updatePage(Post $post) {
        $categories = Category::all();
        return view("pages.post.update", [
            "post" => $post,
            "categories" => $categories,
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

        /** @var Post $post */
        $post = Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user->id,
            'slug' => '',
        ]);

        if (!empty($validatedData['categories'])) {
            $post->categories()->sync($validatedData['categories']);
        }

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

        if (!empty($validatedData['categories'])) {
            $post->categories()->sync($validatedData['categories']);
        }

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
