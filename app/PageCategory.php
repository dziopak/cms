<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

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
}
