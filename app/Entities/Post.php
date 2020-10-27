<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

use App\Events\Posts\PostCreateEvent;
use App\Events\Posts\PostUpdateEvent;
use App\Events\Posts\PostDestroyEvent;
use App\Traits\Sluggable;


class Post extends Model
{
    use Sluggable;
    protected $guarded = ['id', 'post_id', 'thumbnail'];
    public $fire_events = true;

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
        return $this->belongsTo('App\Entities\PostCategory', 'category_id');
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

        self::created(function ($post) use ($request) {
            if ($post->fire_events) event(new PostCreateEvent($post, $request->file('thumbnail')));
        });

        self::updated(function ($post) use ($request) {
            if ($post->fire_events) event(new PostUpdateEvent($post, $request->file('thumbnail')));
        });

        self::deleted(function ($post) use ($request) {
            if ($post->fire_events) event(new PostDestroyEvent($post));
        });
    }
}
