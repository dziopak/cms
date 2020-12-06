<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\File;

class Slider extends Model
{

    public $timestamps = false, $cacheFor = 3600;
    protected $fillable = ['name'];
    protected static $flushCacheOnUpdate = true;

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('title', 'url', 'description');
    }

    public function scopeFilter($query, $request)
    {
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
