<?php

namespace plugins\Testimonials\Entities;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = ['id'];

    public function thumbnail()
    {
        return $this->belongsTo("App\Models\File", 'file_id');
    }


    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {
            // Search in name or slug //
            $query->where('author', 'like', '%' . $request->get('search') . '%');
        }
        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        }
    }
}
