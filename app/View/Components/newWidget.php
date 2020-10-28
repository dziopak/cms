<?php

namespace App\View\Components;

use Illuminate\View\Component;

class newWidget extends Component
{
    public $title;
    public $thumbnail;

    public function __construct($title, $thumbnail)
    {
        $this->title = $title;
        $this->thumbnail = $thumbnail;
    }


    public function render()
    {
        return view('admin.components.containers.new_widget');
    }
}
