<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // TO DO //
    protected $fillable = ['name', 'excerpt', 'slug', 'content', 'file_id', 'user_id', 'category_id', 'meta_title', 'meta_description', 'name_pl', 'slug_pl', 'excerpt_pl', 'content_pl', 'meta_title_pl', 'meta_description_pl', 'index', 'follow' ];
    // Fillable hook for langs //


    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thumbnail() {
        return $this->belongsTo('App\File', 'file_id');
    }

    public function category() {
        return $this->belongsTo('App\PostCategory', 'category_id');
    }

    public function scopeFilter($query, $request) {
        if (!empty($request->get('search'))) {

            // Search in name or slug //
            $query->where('name', 'like', '%'.$request->get('search').'%')
            ->orWhere('slug', 'like', '%'.$request->get('search').'%');
        
        }
        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
            $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        
        }
    }
}
