<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DisplayNumSelectForm extends Component
{
    public function __construct(
        public string $route = '',
        public int $displayNum = 10
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.displayNumSelectForm');
    }
}
