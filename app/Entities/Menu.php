<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Menu extends Model
{
    use QueryCacheable;

    protected $guarded = ['items'];
    public $timestamps = false, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'menu')->orderBy('sort');
    }

    static function find($id)
    {
        return self::where(['name' => $id])->orWhere(['id' => $id])->first();
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {
            // Search in name //
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        } else {
            $query->orderByDesc('id');
        }
    }
}
