<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use App\Traits\Sluggable;

class PostCategory extends Model
{
    use Sluggable;
    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events;

    public function posts()
    {
        return $this->hasMany('App\Entities\Post', 'category_id');
    }

    public static function list_all()
    {
        return DB::table('post_categories')->pluck('name', 'id')->all();
    }

    public static function boot()
    {
        parent::boot();
        $request = request();

        self::created(function ($category) use ($request) {
            if ($category->fire_events) {
                event(new CategoryCreateEvent($category, 'POST'));
                $request->session()->flash('crud', __('admin/messages.categories.create.success'));
            }
        });

        self::updated(function ($category) use ($request) {
            if ($category->fire_events) {
                event(new CategoryUpdateEvent($category, 'POST'));
                $request->session()->flash('crud', __('admin/messages.categories.update.success'));
            }
        });

        self::deleted(function ($category) use ($request) {
            if ($category->fire_events) {
                event(new CategoryDestroyEvent($category, 'POST'));
            }

            $category->posts()->update(['category_id' => 0]);
        });
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
