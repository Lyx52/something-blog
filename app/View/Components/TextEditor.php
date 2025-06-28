<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextEditor extends Component
{
    public array $toolbar = [];
    public string $editorName;
    public string $label;
    public string $value;
    /**
     * Create a new component instance.
     */
    public function __construct(string $editorName, string $config = 'default', string $label = '', string $value = '')
    {
        $this->editorName = $editorName;
        $this->toolbar = config("editor.$config");
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-editor');
    }
}
