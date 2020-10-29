<?php

namespace App\View\Components\Admin\Containers\Widgets;

use Illuminate\View\Component;

class Create extends Component
{
    public $title;
    public $thumbnail;

    public function __construct($title, $thumbnail = "")
    {
        $this->title = $title;
        $this->thumbnail = $thumbnail;
    }


    public function render()
    {
        return view('admin.components.containers.widgets.new_widget');
    }
}
