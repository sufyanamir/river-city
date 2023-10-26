<?php

namespace App\View\Components;

use Illuminate\View\Component;

class addButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $class;
    public $id;
    public function __construct($title, $class,$id)
    {
        $this->title = $title;
        $this->class = $class;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.add-button');
    }
}
