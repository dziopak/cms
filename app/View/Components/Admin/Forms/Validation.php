<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\View\Component;

class Validation extends Component
{

    public $errors;


    public function __construct($errors)
    {
        $this->errors = $errors;
    }


    public function render()
    {
        return view('admin.components.forms.validation');
    }
}
