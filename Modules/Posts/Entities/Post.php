<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'excerpt', 'slug', 'content', 'photo_id', 'user_id', 'category_id'];

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }
}

