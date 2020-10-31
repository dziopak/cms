<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;
    public $cacheFor = 3600, $timestamps = false;
    protected $fillable = ['user_id', 'widgets'];
}
