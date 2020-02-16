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
}
