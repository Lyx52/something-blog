<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public string $label;
    public string $href;
    public string $color;
    public string $colorHover;
    public string $colorText;
    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $href, string $linkType = 'primary')
    {
        $this->color = match ($linkType) {
            "success" => "green-400",
            "warning" => "yellow-400",
            "danger" => "red-400",
            "info" => "teal-400",
            "dark" => "gray-700",
            "light" => "gray-200",
            default => "blue-400"
        };

        $this->colorHover = match ($linkType) {
            "success" => "green-500",
            "warning" => "yellow-500",
            "danger" => "red-500",
            "info" => "teal-500",
            "dark" => "gray-800",
            "light" => "gray-300",
            default => "blue-500"
        };

        $this->colorText = match ($linkType) {
            "light" => "black",
            default => "white"
        };


        $this->label = $label;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.link');
    }
}
