<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class CommentController extends Controller
{
    public function create(CreateCommentRequest $request) {
        $validatedData = $request->validated();
        $comment = Purify::config('comments')->clean($validatedData['comment']);
        $user = Auth::user();

        if (empty($user)) {
            return route('auth.login.page');
        }

        $post = Post::query()->findOrFail($validatedData['id']);

        Comment::create([
            'comment' => $comment,
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        return redirect()->route('post.view.page', [
            'post' => $post,
        ]);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
