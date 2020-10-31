<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;
    protected $fillable = ['title', 'config', 'type', 'x', 'y', 'layout_id', 'width', 'height', 'container'];
    public $timestamps = false, $cacheFor = 3600;

    public function layouts()
    {
        return $this->belongsTo(\App\Entities\Layout::class);
    }
}
