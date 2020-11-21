<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use QueryCacheable;


    protected $fillable = ['user_id', 'target_id', 'type', 'crud_action', 'message', 'target_name'];
    protected $table = 'logs';

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


    public function author()
    {
        return $this->belongsTo('App\Entities\User', 'user_id', 'id');
    }


    public function target()
    {
        return $this->belongsTo('App\Entities\\' . camelCase(strToLower($this->type)));
    }
}
