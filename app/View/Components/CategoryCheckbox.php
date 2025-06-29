<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryCheckbox extends Component
{
    public string $title;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->title = 'All';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.category-checkbox');
    }
}
