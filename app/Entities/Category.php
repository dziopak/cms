<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Categories\CategoryEntity;
use App\Http\Utilities\Admin\Modules\Categories\CategoryActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\EntityTrait;
use App\Traits\Linkable;
use App\Traits\MassEditable;
use App\Traits\Sluggable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Eventy;

use App\Entities\Post;

class Category extends Model
{
    use HasFactory;
    use Sluggable, Linkable, MassEditable;
    use QueryCacheable;
    use EntityTrait;

    protected $entity_type = 'categories';
    protected $webEntity = CategoryEntity::class;
    protected $massActions = CategoryActions::class;
    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public $timestamps = false;


    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }


    public function pages()
    {
        return $this->morphedByMany(Page::class, 'categorizable');
    }


    public function categories()
    {
        return Category::where(['category_id' => $this->id])->get();
    }


    public function scopeList($query, $no_category = true)
    {
        $categories = $query->pluck('name', 'id')->toArray();
        if (!$no_category) return $query->pluck('name', 'id')->toArray();

        return array(0 => __('admin/post_categories.no_category')) + $categories;
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


    static function synchronize($item, $categories)
    {
        if (!$item->isDirty()) get_class($item)::flushQueryCache();
        $item->categories()->sync($categories);

        return $item->fresh();
    }


    public function getUrl()
    {
        return route('front.categories.show', $this->slug);
    }


    public function getName()
    {
        return Eventy::filter('category.entity.getName', $this->attributes['name'], $this->attributes);
    }


    public function getExcerpt()
    {
        return Eventy::filter('category.entity.getDescription', $this->attributes['description'], $this->attributes);
    }
}
