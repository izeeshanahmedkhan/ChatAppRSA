<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MessagesPanel extends Component
{
    /**
    * @var string
    */
    public $author;

    /**
    * Create a new component instance.
    *
    * @param string $author
    */
    public function __construct(string $author)
    {
    $this->author = $author;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.messages-panel');
    }
}
