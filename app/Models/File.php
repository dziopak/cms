<?php

namespace App\Models;

use App\Events\Files\FileDestroyEvent;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;

class File extends Model
{
    protected $table = "files";
    protected $fillable = ['type', 'path', 'name', 'description'];

    public function posts()
    {
        return $this->hasMany('\App\Models\Post', 'file_id');
    }

    public function pages()
    {
        return $this->hasMany('\App\Models\Page', 'file_id');
    }

    public function users()
    {
        return $this->hasMany('\App\Models\User', 'avatar');
    }

    public function sliders()
    {
        return $this->belongsToMany(Slider::class);
    }

    public function getRelated()
    {
        $relatedModels = [
            $this->posts,
            $this->pages,
            $this->users,
        ];

        $related = collect();
        foreach ($relatedModels as $model) {
            $related = $related->merge($model);
        }
        return $related;
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {
            // Search in name or slug //
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'asc' ?
                $query->orderBy($request->get('sort_by')) : $query->orderByDesc($request->get('sort_by'));
        } else {

            $query->orderByDesc('id');
        }
    }

    public function countRelated()
    {
        $count = $this->withCount('posts');
        return $count;
    }

    public static function boot()
    {
        parent::boot();
        $request = request();

        self::deleted(function ($file) use ($request) {
            unlink(public_path() . '/images/' . $file->path);
            event(new FileDestroyEvent($file));
        });
    }
}
