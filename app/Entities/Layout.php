<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Block;

class Layout extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;
    public $cacheFor = 3600, $timestamps = false;
    protected $guarded = [];


    public function blocks()
    {
        return $this->hasMany(Block::class);
    }


    public function scopelist()
    {
        return Layout::select('id', 'name')->pluck('name', 'id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($layout) {
            $layout->blocks()->delete();
        });
    }
}
