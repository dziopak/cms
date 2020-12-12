<?php

namespace App\Entities;

use App\Http\Resources\PageResource;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Traits\Filterable;
use App\Traits\Linkable;
use App\Traits\Sluggable;
use App\Traits\Thumbnail;
use Hook;


class Page extends Model implements Searchable
{

    /*
     * TRAITS
    */
    use Thumbnail, Sluggable, Linkable, Filterable, QueryCacheable;


    /*
     * PROPERTIES
    */
    protected $guarded = ['id', 'page_id'];
    private $searchIn = ['name', 'slug'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'pages';
    public $resources = [
        'collection' => PageResource::class
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
    public function layout()
    {
        $default = config()['global']['content']['page_layout'];
        return $this->belongsTo('App\Entities\Layout', 'layout_id')
            ->withDefault(Layout::findOrFail($default));
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('admin.pages.edit', $this->id)
        );
    }


    /*
     * GETTERS
    */
    public function getName()
    {
        return Hook::filter('page.entity.getName', $this->attributes['name'], $this->attributes);
    }

    public function getExcerpt()
    {
        return Hook::filter('page.entity.getExcerpt', $this->attributes['excerpt'], $this->attributes);
    }

    public function getContent()
    {
        return Hook::filter('page.entity.getContent', $this->attributes['content'], $this->attributes);
    }

    public function getMetaTitle()
    {
        return Hook::filter('page.entity.getMetaTitle', $this->attributes['meta_title'], $this->attributes);
    }

    public function getMetaDescription()
    {
        return Hook::filter('post.entity.getMetaDescription', $this->attributes['meta_description'], $this->attributes);
    }
}
