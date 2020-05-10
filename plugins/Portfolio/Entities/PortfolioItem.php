<?php

namespace plugins\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;
use plugins\Portfolio\Events\PortfolioItemCreateEvent;
use plugins\Portfolio\Events\PortfolioItemUpdateEvent;
use plugins\Portfolio\Events\PortfolioItemDestroyEvent;

class PortfolioItem extends Model
{
    protected $guarded = [];
    public $fire_events = true;

    public function photos()
    {
        return $this->hasMany('plugins\Portfolio\Entities\PortfolioItemPicture', 'portfolio_item_id');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\File', 'file_id');
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

        self::created(function ($item) use ($request) {
            if ($item->fire_events) event(new PortfolioItemCreateEvent($item, $request->file('thumbnail')));
        });

        self::saving(function ($item) use ($request) {
            if ($item->fire_events) event(new PortfolioItemUpdateEvent($item, $request->file('thumbnail')));
        });

        self::deleted(function ($item) use ($request) {
            if ($item->fire_events) event(new PortfolioItemDestroyEvent($item));
        });
    }
}