<?php

namespace App\View\Components;

use App\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentView extends Component
{
    public Comment $comment;
    /**
     * Create a new component instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content.comment-view');
    }
}
