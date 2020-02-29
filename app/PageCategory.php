<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageCategory extends Model
{
    protected $guarded = ['id', 'category_id'];

    public function pages() {
        return $this->hasMany('App\Page', 'category_id');
    }

    public function list_all() {
        return $categories = DB::table('page_categories')->pluck('name', 'id')->all();
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->pages()->update(['category_id' => 0]);
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
