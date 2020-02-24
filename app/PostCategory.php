<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    public function posts() {
        return $this->hasMany('App\Post', 'category_id');
    }

    public function list_all() {
        return $categories = DB::table('post_categories')->pluck('name', 'id')->all();
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->posts()->update(['category_id' => 0]);
        });
    }

    public function scopeFilter($query, $request) {
        if (!empty($request->get('search'))) {

            // Search in name //
            $query->where('name', 'like', '%'.$request->get('search').'%');
        
        }
        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
            $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        
        }
    }
}
