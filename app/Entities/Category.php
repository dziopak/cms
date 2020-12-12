<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Model;

use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Traits\Linkable;
use App\Traits\Sluggable;
use App\Traits\Filterable;

use App\Entities\Post;
use App\Traits\Listable;
use Hook;

class Category extends Model
{
    use HasFactory, Filterable;
    use Sluggable, Linkable, Listable;
    use QueryCacheable;

    protected $entity_type = 'categories';
    protected $guarded = ['id', 'type'];
    private $searchIn = ['name', 'description'];
    public $fire_events = true, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public $timestamps = false;

    public $resources = [
        'collection' => CategoryResource::class
    ];


    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }


    public function pages()
    {
        return $this->morphedByMany(Page::class, 'categorizable');
    }


    public function category()
    {
        return Category::where(['category_id' => $this->id])->get();
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
        return Hook::filter('category.entity.getName', $this->attributes['name'], $this->attributes);
    }


    public function getExcerpt()
    {
        return Hook::filter('category.entity.getDescription', $this->attributes['description'], $this->attributes);
    }
}
