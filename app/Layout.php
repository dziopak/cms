<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(\App\Block::class);
    }

    public function scopelist()
    {
        return Layout::select('id', 'name')->pluck('name', 'id');
    }
}
