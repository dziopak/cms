<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\Sluggable;

class PostCategory extends Model
{
    use Sluggable;
    use QueryCacheable;

    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public function posts()
    {
        return $this->hasMany('App\Entities\Post', 'category_id');
    }

    public static function list_all()
    {
        return DB::table('post_categories')->pluck('name', 'id')->all();
    }

    public function scopeFilter($query, $request)
    {
        $request = request();

        if (!empty($request->get('search'))) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        }
    }
}
