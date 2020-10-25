<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['items'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\MenuItem', 'menu')->orderBy('sort');
    }
}
