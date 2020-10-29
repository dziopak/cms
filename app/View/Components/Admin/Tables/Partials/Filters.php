<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Filters extends Component
{

    public $sort;


    public function __construct($sort)
    {
        $this->sort = $sort;
    }


    public function render()
    {
        return view('admin.components.tables.partials.filters');
    }
}
