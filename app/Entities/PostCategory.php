<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Categories\PostCategoryEntity;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\EntityTrait;
use App\Traits\Sluggable;
use App\Traits\Linkable;

class PostCategory extends Model
{
    use Sluggable, Linkable;
    use QueryCacheable;
    use EntityTrait;

    protected $entity_type = 'posts.categories';
    protected $webEntity = PostCategoryEntity::class;

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
