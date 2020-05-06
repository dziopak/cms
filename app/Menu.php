<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['items'];
    public $timestamps = false;
    // protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany('App\MenuItem', 'menu')->orderBy('sort');
    }
}
