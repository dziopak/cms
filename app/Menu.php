<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class Menu extends Menus
{
    public function items() {
        return $this->hasMany('App\MenuItem', 'menu');
    }
}
