<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['title', 'config', 'type'];
    public $timestamps = false;

    public function layouts()
    {
        return $this->belongsToMany(\App\Layout::class)->withPivot('x', 'y', 'width', 'height');
    }
}
