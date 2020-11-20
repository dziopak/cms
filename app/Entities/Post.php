<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Posts\PostEntity as WebEntity;
use App\Http\Utilities\Api\Posts\PostEntity as ApiEntity;
use App\Http\Utilities\Admin\Modules\Posts\PostActions;
use App\Traits\EntityTrait;
use App\Traits\Linkable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\Thumbnail;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use Sluggable, Linkable;
    use QueryCacheable;
    use Thumbnail, EntityTrait;

    public $cacheFor = 3600, $fire_events = true;
    protected static $flushCacheOnUpdate = true;

    protected $entity_type = 'posts',
        $guarded = ['id', 'post_id', 'thumbnail'];

    private $webEntity = WebEntity::class, $apiEntity = ApiEntity::class;
    protected $massActions = PostActions::class;


    public function author()
    {
        return $this->belongsTo('App\Entities\User', 'user_id');
    }


    public function thumbnail()
    {
        return $this->belongsTo('App\Entities\File', 'file_id');
    }


    public function category()
    {
        return $this->belongsTo('App\Entities\PostCategory', 'category_id');
    }


    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {
            // Search in name or slug //
            $query->where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('slug', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        } else {
            $query->orderByDesc('created_at');
        }
    }


    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('admin.posts.edit', $this->id)
        );
    }
}
