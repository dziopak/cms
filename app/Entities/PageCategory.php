<?php

namespace App\Entities;

use App\Traits\Linkable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\Sluggable;

class PageCategory extends Model
{
    use Sluggable;
    use QueryCacheable;
    use Linkable;


    protected $entity_type = 'pages.categories';
    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


    public function pages()
    {
        return $this->hasMany('App\Entities\Page', 'category_id');
    }

    public static function list_all()
    {
        return DB::table('page_categories')->pluck('name', 'id')->all();
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
        }
    }
}
