<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;
use App\Traits\Sluggable;

class Page extends Model
{
    protected $guarded = ['id', 'page_id'];
    public $fire_events = true;

    use Sluggable;

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
                $request->session()->flash('crud', __('admin/messages.pages.create.success'));
            }
        });

        self::updated(function ($page) use ($request) {
            if ($page->fire_events) {
                event(new PageUpdateEvent($page, $request->file('thumbnail')));
                $request->session()->flash('crud', __('admin/messages.pages.update.success'));
            }
        });

        self::deleted(function ($page) use ($request) {
            if ($page->fire_events) {
                event(new PageDestroyEvent($page));
            }
        });
    }
}
