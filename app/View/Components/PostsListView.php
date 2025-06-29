<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class PostsListView extends Component
{
    public LengthAwarePaginator $pagination;

    /**
     * Create a new component instance.
     */
    public function __construct(LengthAwarePaginator $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content.posts-list-view');
    }
}
