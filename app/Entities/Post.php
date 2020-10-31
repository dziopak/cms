<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use Sluggable;
    use QueryCacheable;

    protected $guarded = ['id', 'post_id', 'thumbnail'];
    public $fire_events = true;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


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
