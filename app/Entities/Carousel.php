<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Blocks\Carousels\CarouselActions;
use App\Http\Utilities\Admin\Blocks\Carousels\CarouselEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Carousel extends Model
{
    use HasFactory;
    use QueryCacheable;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($carousel) {
            $carousel->files()->detach();
        });
    }

    public function scopeFilter($query)
    {
        $request = request();
        if (!empty($request->get('search'))) {
            // Search in name or slug //
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        } else {
            $query->orderByDesc('id');
        }
    }
}
