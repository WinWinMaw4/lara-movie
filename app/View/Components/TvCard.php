<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvCard extends Component
{

    public $genres;
    public $tv;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($genres,$tv)
    {
        //

        $this->genres = $genres;
        $this->tv = $tv;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
