<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Slider extends Model
{
    public $timestamps = false, $cacheFor = 3600;
    protected $fillable = ['name'];
    protected static $flushCacheOnUpdate = true;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }
}
