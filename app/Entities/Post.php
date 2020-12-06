<?php

namespace App\Entities;

use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Model;

use App\Http\Utilities\Admin\Modules\Posts\PostActions;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Traits\Linkable;
use App\Traits\Sluggable;
use App\Traits\Thumbnail;

use Eventy;

class Post extends Model implements Searchable
{
    use Sluggable, Linkable;
    use QueryCacheable;
    use Thumbnail;

    public $cacheFor = 3600, $fire_events = true;

    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'posts';
    protected $guarded = ['id', 'post_id', 'thumbnail'];


    public $resources = [
        'collection' => PostResource::class
    ];


    public function author()
    {
        return $this->belongsTo('App\Entities\User', 'user_id');
    }


    public function thumbnail()
    {
        return $this->belongsTo('App\Entities\File', 'file_id');
    }


    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }


    public function scopeFilter($query)
    {
        $request = request();
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


    public function getName()
    {
        return Eventy::filter('post.entity.getName', $this->attributes['name'], $this->attributes);
    }


    public function getExcerpt()
    {
        return Eventy::filter('post.entity.getExcerpt', $this->attributes['excerpt'], $this->attributes);
    }


    public function getContent()
    {
        return Eventy::filter('post.entity.getContent', $this->attributes['content'], $this->attributes);
    }


    public function getMetaTitle()
    {
        return Eventy::filter('post.entity.getMetaTitle', $this->attributes['meta_title'], $this->attributes);
    }


    public function getMetaDescription()
    {
        return Eventy::filter('post.entity.getMetaDescription', $this->attributes['meta_description'], $this->attributes);
    }
}
