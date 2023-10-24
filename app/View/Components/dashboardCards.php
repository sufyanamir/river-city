<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dashboardCards extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $value;
    public $img;
    public function __construct($title, $value, $img)
    {
        $this->title = $title;
        $this->value = $value;
        $this->img = $img;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-cards');
    }
}
