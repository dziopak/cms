<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;


class PostCategory extends Model
{
    protected $guarded = ['id', 'category_id', 'type'];
    public $fire_events;

    public function posts() {
        return $this->hasMany('App\Post', 'category_id');
    }

    public static function list_all() {
        return $categories = DB::table('post_categories')->pluck('name', 'id')->all();
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($category) {
            if ($category->fire_events) {
                event(new CategoryCreateEvent($category, 'POST'));
                $request->session()->flash('crud', 'Category '.$category->name.' has been created successfully.');
            }
        });

        self::updated(function($category) {
            if ($category->fire_events) {
                event(new CategoryUpdateEvent($category, 'POST'));
                $request->session()->flash('crud', 'Category '.$category->name.' has been updated successfully.');
            }
        });

        self::deleted(function($category) {
            if ($category->fire_events) {
                event(new CategoryDestroyEvent($category, 'POST'));
                $request->session()->flash('crud', 'Category '.$category->name.' has been deleted successfully.');
            }

            $category->posts()->update(['category_id' => 0]);
        });
    }

    public function scopeFilter($query, $request) {
        if (!empty($request->get('search'))) {

            // Search in name //
            $query->where('name', 'like', '%'.$request->get('search').'%');

        }

        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
            $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));

        }
    }
}
