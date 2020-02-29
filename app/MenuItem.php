<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Harimayco\Menu\Models\MenuItems;

class MenuItem extends MenuItems
{
    public function menu() {
        return $this->belongsTo('App\Menu');
    }
}
