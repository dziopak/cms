<?php

namespace App\View\Components\Admin\Other;

use Illuminate\View\Component;

class UserProfile extends Component
{

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function render()
    {
        return view('admin.components.other.userprofile');
    }
}
