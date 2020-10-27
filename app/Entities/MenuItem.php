<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth'];
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo('App\Entities\Menu');
    }

    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'parent');
    }
}
