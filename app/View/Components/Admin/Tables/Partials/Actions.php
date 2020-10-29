<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Actions extends Component
{
    public $field;
    public $actions;


    public function __construct($field, $actions)
    {
        $this->field = $field;
        $this->actions = $actions;
    }


    public function render()
    {
        return view('admin.components.tables.partials.actions');
    }
}
