<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'excerpt', 'slug', 'content', 'file_id', 'user_id', 'category_id', 'meta_title', 'meta_description'];

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thumbnail() {
        return $this->belongsTo('App\File', 'file_id');
    }

    public function category() {
        return $this->belongsTo('App\PostCategory', 'category_id');
    }
}
