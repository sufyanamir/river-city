<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidebarLinks extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $icon;
    public $class;

    public function __construct($title, $icon, $class)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-links');
    }
}
