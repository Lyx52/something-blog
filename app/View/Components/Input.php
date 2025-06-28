<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $label;
    public string $inputName;
    public string $type;

    /**
     * Create a new component instance.
     */
    public function __construct(string $inputName, string $label, string $type = "text")
    {
        $this->inputName = $inputName;
        $this->label = $label;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
