<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Pages\PageActions;
use App\Http\Utilities\Admin\Modules\Pages\PageEntity as WebEntity;
use App\Http\Utilities\Api\Pages\PageEntity as ApiEntity;
use App\Traits\EntityTrait;
use App\Traits\Linkable;
use App\Traits\MassEditable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Eventy;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use App\Traits\Sluggable;
use App\Traits\Thumbnail;

class Page extends Model implements Searchable
{

    use Sluggable, Linkable, MassEditable;
    use QueryCacheable;
    use Thumbnail;
    use EntityTrait;

    protected $guarded = ['id', 'page_id'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $entity_type = 'pages';
    protected $massActions = PageActions::class;
    protected $webEntity = WebEntity::class, $apiEntity = ApiEntity::class;

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


    public function layout()
    {
        $default = config()['global']['content']['page_layout'];
        return $this->belongsTo('App\Entities\Layout', 'layout_id')
            ->withDefault(Layout::findOrFail($default));
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
            $query->orderByDesc('id');
        }
    }


    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('admin.pages.edit', $this->id)
        );
    }


    public function getName()
    {
        return Eventy::filter('page.entity.getName', $this->attributes['name'], $this->attributes);
    }


    public function getExcerpt()
    {
        return Eventy::filter('page.entity.getExcerpt', $this->attributes['excerpt'], $this->attributes);
    }


    public function getContent()
    {
        return Eventy::filter('page.entity.getContent', $this->attributes['content'], $this->attributes);
    }


    public function getMetaTitle()
    {
        return Eventy::filter('page.entity.getMetaTitle', $this->attributes['meta_title'], $this->attributes);
    }

    public function getMetaDescription()
    {
        return Eventy::filter('post.entity.getMetaDescription', $this->attributes['meta_description'], $this->attributes);
    }
}
