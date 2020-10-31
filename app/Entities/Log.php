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
        switch ($this->type) {
            case 'USER':
                return $this->belongsTo('App\Entities\User', 'target_id', 'id');
                break;

            case 'ROLE':
                return $this->belongsTo('App\Entities\Role', 'target_id', 'id');
                break;

            case 'POST':
                return $this->belongsTo('App\Entities\Post', 'target_id', 'id');
                break;

            case 'POST_CATEGORY':
                return $this->belongsTo('App\Entities\PostCategory', 'target_id', 'id');
                break;

            case 'PAGE':
                return $this->belongsTo('App\Entities\Page', 'target_id', 'id');
                break;

            case 'PAGE_CATEGORY':
                return $this->belongsTo('App\Entities\PageCategory', 'target_id', 'id');
                break;
        }
    }
}
