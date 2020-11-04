<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class MenuItem extends Model
{
    use QueryCacheable;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth'];
    public $timestamps = false, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public function menu()
    {
        return $this->belongsTo('App\Entities\Menu');
    }

    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'parent');
    }
}
