<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth'];
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function items()
    {
        return $this->hasMany('App\Models\MenuItem', 'parent');
    }
}
