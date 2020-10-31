<?php

namespace App\Plugins\Lang\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $fillable = ['name', 'origin_name', 'lang_tag'];
}
