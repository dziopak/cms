<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Filters extends Component
{

    public $sort;
    public $type;


    public function __construct($sort = null, $type = "default")
    {
        $this->sort = $sort;
        $this->type = $type;
    }


    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.filters');
    }
}
