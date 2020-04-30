<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;


class Page extends Model
{
    protected $guarded = ['id', 'page_id'];
    public $fire_events = true;


    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\File', 'file_id');
    }

    public function category()
    {
        return $this->belongsTo('App\PageCategory', 'category_id');
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
        }
    }

    public static function boot()
    {
        parent::boot();
        $request = request();

        self::created(function ($page) use ($request) {
            if ($page->fire_events) {
                event(new PageCreateEvent($page, $request->file('thumbnail')));
                $request->session()->flash('crud', 'Page ' . $page->name . ' has been created successfully.');
            }
        });

        self::updated(function ($page) use ($request) {
            if ($page->fire_events) {
                event(new PageUpdateEvent($page, $request->file('thumbnail')));
                $request->session()->flash('crud', 'Page ' . $page->name . ' has been updated successfully.');
            }
        });

        self::deleted(function ($page) use ($request) {
            if ($page->fire_events) {
                event(new PageDestroyEvent($page));
                $request->session()->flash('crud', 'Page ' . $page->name . ' has been deleted successfully.');
            }
        });
    }
}
