<?php

namespace App\View\Components\Admin\Containers\Wrappers;

use Illuminate\View\Component;

class Wrapper extends Component
{

    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = "")
    {
        $this->title = __($title);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('admin.components.containers.wrappers.wrapper');
    }
}
