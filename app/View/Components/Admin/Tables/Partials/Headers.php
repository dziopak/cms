<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Headers extends Component
{

    public $headers;
    public $actions, $show_actions;
    public $type;

    public function __construct($headers = null, $actions = null, $show_actions = true, $type = 'default')
    {
        $this->headers = $headers;
        $this->actions = $actions;
        $this->show_actions = $show_actions;
        $this->type = $type;
    }

    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.headers');
    }
}
