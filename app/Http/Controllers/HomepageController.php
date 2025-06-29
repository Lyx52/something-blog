<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index() {
        $pagination = Post::query()->orderBy('created_at', 'desc')
            ->paginate(10)
            ->setPath(route('home.load-more'));

        return view("pages.home.index", [
            'pagination' => $pagination,
            'userPosts' => false
        ]);
    }

    public function userPosts() {
        /** @var User $user */
        $user = Auth::user();
        $pagination = $user->posts()->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends('user', true)
            ->setPath(route('home.load-more'));

        return view("pages.home.index", [
            'pagination' => $pagination,
            'userPosts' => true
        ]);
    }

    public function loadMore(Request $request) {
        $userPosts = $request->boolean("user");
        $search = $request->string("query", '')->toString();
        $query = Post::query();

        // Load more users posts
        if ($userPosts && Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            $query = $user->posts();
        }
        if (!empty($search)) {
            $query = $query
                ->whereFullText(['title', 'body'], $search)
                ->orWhereLike('title', '%' . $search . '%');
        }

        $pagination = $query->orderBy('created_at', 'desc')->paginate(10);

        return view("components.content.posts-list-view", [
            'pagination' => $pagination
        ]);
    }
}
