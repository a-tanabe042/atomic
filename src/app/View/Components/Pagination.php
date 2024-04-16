<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class Pagination extends Component
{
    public function __construct(
        public ?LengthAwarePaginator $query = null,
        public ?array $filterEngineerFlg = [],
        public ?string $displaySelect = '10',
        public string $class = '',
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
