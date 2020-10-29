<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Action extends Component
{

    public $key;


    public function __construct($key)
    {
        $this->key = $key;
    }


    public function render()
    {
        return view('admin.components.tables.partials.action');
    }
}
