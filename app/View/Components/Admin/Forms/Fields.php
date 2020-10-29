<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\View\Component;

class Fields extends Component
{

    public $fields;


    public function __construct($fields)
    {
        $this->fields = $fields;
    }


    public function render()
    {
        return view('admin.components.forms.fields');
    }
}
