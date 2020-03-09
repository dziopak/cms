<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Harimayco\Menu\Models\MenuItems;

class MenuItem extends MenuItems
{
    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth'];
    public function menu() {
        return $this->belongsTo('App\Menu');
    }
}
