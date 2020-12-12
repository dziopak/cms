<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Events\Files\FileDestroyEvent;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Entities\Slider;
use App\Traits\Filterable;

class File extends Model
{
    use Filterable, QueryCacheable;

    public $cacheFor = 3600;
    protected $table = "files";
    protected static $flushCacheOnUpdate = true;
    protected $fillable = ['type', 'path', 'name', 'description'];
    private $searchIn = ['name', 'description'];


    public function posts()
    {
        return $this->hasMany('\App\Entities\Post', 'file_id');
    }


    public function pages()
    {
        return $this->hasMany('\App\Entities\Page', 'file_id');
    }


    public function users()
    {
        return $this->hasMany('\App\Entities\User', 'avatar');
    }


    public function sliders()
    {
        return $this->belongsToMany(Slider::class);
    }


    public function carousels()
    {
        return $this->belongsToMany(Carousel::class);
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


    public function countRelated()
    {
        $count = $this->withCount('posts');
        return $count;
    }


    public static function boot()
    {
        parent::boot();

        self::deleted(function ($file) {
            unlink(public_dir() . '/images/' . $file->path);
            event(new FileDestroyEvent($file));
        });
    }
}
