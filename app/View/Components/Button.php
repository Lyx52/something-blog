<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $color;
    public string $colorHover;
    public string $colorText;
    public string $label;
    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $buttonType = "primary")
    {
        $this->color = match ($buttonType) {
            "success" => "green-500",
            "warning" => "yellow-500",
            "danger" => "red-500",
            "info" => "teal-500",
            "dark" => "gray-700",
            "light" => "gray-200",
            default => "indigo-500"
        };

        $this->colorHover = match ($buttonType) {
            "success" => "green-600",
            "warning" => "yellow-600",
            "danger" => "red-600",
            "info" => "teal-600",
            "dark" => "gray-800",
            "light" => "gray-300",
            default => "indigo-600"
        };

        $this->colorText = match ($buttonType) {
            "light" => "black",
            default => "white"
        };

        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.button');
    }
}
