<?php

namespace App\Entities;

use App\Traits\Linkable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use App\Traits\Sluggable;

class Page extends Model implements Searchable
{

    use Sluggable;
    use Linkable;
    use QueryCacheable;

    protected $guarded = ['id', 'page_id'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'pages';

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
        return $this->belongsTo('App\Entities\PageCategory', 'category_id');
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
}
