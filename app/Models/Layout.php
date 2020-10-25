<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Block;

class Layout extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function scopelist()
    {
        return Layout::select('id', 'name')->pluck('name', 'id');
    }
}
