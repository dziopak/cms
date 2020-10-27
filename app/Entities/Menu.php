<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['items'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'menu')->orderBy('sort');
    }
}
