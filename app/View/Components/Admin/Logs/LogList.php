<?php

namespace App\View\Components\Admin\Logs;

use Illuminate\View\Component;

class LogList extends Component
{

    public $logs;


    public function __construct($data)
    {
        $this->logs = $data;
    }


    public function render()
    {
        return view('admin.components.logs.list');
    }
}
