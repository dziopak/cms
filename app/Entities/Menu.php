<?php

namespace App\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Menu extends Model
{
    use Filterable, QueryCacheable;

    protected $guarded = ['items'];
    public $timestamps = false, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    private $searchIn = ['name'];


    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'menu')->orderBy('sort');
    }

    static function find($id)
    {
        return self::where(['name' => $id])->orWhere(['id' => $id])->first();
    }
}
