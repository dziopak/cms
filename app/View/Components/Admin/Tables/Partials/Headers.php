<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Headers extends Component
{

    public $headers;
    public $actions, $show_actions;

    public function __construct($headers, $actions = null, $show_actions = true)
    {
        $this->headers = $headers;
        $this->actions = $actions;
        $this->show_actions = $show_actions;
    }

    public function render()
    {
        return view('admin.components.tables.partials.headers');
    }
}
