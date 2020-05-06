<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth'];
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
