<?php

namespace App\View\Components\Admin\Modals;

use Illuminate\View\Component;

class Delete extends Component
{

    public $id, $title, $message;


    public function __construct($id, $title, $message)
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
    }


    public function render()
    {
        return view('admin.components.modals.delete');
    }
}
