<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function blocks()
    {
        return $this->belongsToMany(\App\Block::class)->withPivot('x', 'y', 'width', 'height');
    }
}
