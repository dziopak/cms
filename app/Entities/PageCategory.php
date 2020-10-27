<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use App\Traits\Sluggable;

class PageCategory extends Model
{
    use Sluggable;
    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events = true;

    public function pages()
    {
        return $this->hasMany('App\Entities\Page', 'category_id');
    }

    public static function list_all()
    {
        return DB::table('page_categories')->pluck('name', 'id')->all();
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

    public static function boot()
    {
        parent::boot();
        $request = request();

        self::created(function ($category) use ($request) {
            if ($category->fire_events) event(new CategoryCreateEvent($category, 'PAGE'));
            $request->session()->flash('crud', __('admin/messages.categories.create.success'));
        });

        self::updated(function ($category) use ($request) {
            if ($category->fire_events) {
                event(new CategoryUpdateEvent($category, 'PAGE'));
                $request->session()->flash('crud', __('admin/messages.categories.update.success'));
            }
        });

        self::deleted(function ($category) use ($request) {
            if ($category->fire_events) {
                event(new CategoryDestroyEvent($category, 'PAGE'));
            }
        });

        static::deleting(function ($category) {
            $category->pages()->update(['category_id' => 0]);
        });
    }
}
