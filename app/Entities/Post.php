<?php

namespace App\Entities;

use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Traits\Filterable;
use App\Traits\Linkable;
use App\Traits\Sluggable;
use App\Traits\Thumbnail;

use Hook;

class Post extends Model implements Searchable
{

    /*
     * TRAITS
    */
    use Thumbnail, Sluggable, Linkable, Filterable, QueryCacheable;


    /*
     * PROPERTIES
    */
    public $cacheFor = 3600, $fire_events = true;
    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'posts';
    protected $guarded = ['id', 'post_id', 'thumbnail'];
    private $searchIn = ['name', 'slug'];
    public $resources = [
        'collection' => PostResource::class
    ];


    /*
     * RELATIONS
    */
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


    /*
     * SCOPES
    */
    public function scopeIndex()
    {
        return $this
            ->with(['thumbnail:id,path', 'author:id,name'])
            ->search()->sort()->paginate(15);
    }


    /*
     * OTHER
    */
    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('admin.posts.edit', $this->id)
        );
    }


    /*
     * GETTERS
    */
    public function getName()
    {
        return Hook::filter('post.entity.getName', $this->attributes['name'], $this->attributes);
    }

    public function getExcerpt()
    {
        return Hook::filter('post.entity.getExcerpt', $this->attributes['excerpt'], $this->attributes);
    }

    public function getContent()
    {
        return Hook::filter('post.entity.getContent', $this->attributes['content'], $this->attributes);
    }

    public function getMetaTitle()
    {
        return Hook::filter('post.entity.getMetaTitle', $this->attributes['meta_title'], $this->attributes);
    }

    public function getMetaDescription()
    {
        return Hook::filter('post.entity.getMetaDescription', $this->attributes['meta_description'], $this->attributes);
    }
}
