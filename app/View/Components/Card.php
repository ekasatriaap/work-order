<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $toolbar;
    public $cardHeader;
    public $cardFooter;

    public function __construct($title = null, $toolbar = null, $cardHeader = true, $cardFooter = false)
    {
        //
        $this->title = $title;
        $this->toolbar = $toolbar;
        $this->cardHeader = $cardHeader === 'false' ? false : $cardHeader;
        $this->cardFooter = $cardFooter == 'false' ? false : $cardFooter;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
